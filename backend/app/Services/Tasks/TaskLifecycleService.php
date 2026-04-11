<?php

namespace App\Services\Tasks;

use App\Enums\ActivityLogType;
use App\Enums\NotificationType;
use App\Enums\TaskStatus;
use App\Enums\TaskTransitionAction;
use App\Models\ActivityLog;
use App\Models\Notification;
use App\Models\Task;
use App\Models\TaskComment;
use App\Models\User;
use App\Models\Workflow;
use App\Models\WorkflowStep;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TaskLifecycleService
{
    public function createTask(array $payload, User $actor): Task
    {
        return DB::transaction(function () use ($payload, $actor): Task {
            $workflow = Workflow::query()->with('steps.team')->findOrFail($payload['workflow_id']);
            $firstStep = $workflow->steps->sortBy('sequence')->first();

            if (! $firstStep) {
                throw ValidationException::withMessages([
                    'workflowId' => ['The selected workflow must contain at least one step.'],
                ]);
            }

            $task = Task::query()->create([
                'title' => $payload['title'],
                'description' => $payload['description'] ?? null,
                'status' => TaskStatus::Open,
                'priority' => $payload['priority'],
                'workflow_id' => $workflow->id,
                'current_workflow_step_id' => $firstStep->id,
                'current_step_index' => 0,
                'assigned_team_id' => $firstStep->team_id,
                'assigned_user_id' => $payload['assigned_user_id'] ?? null,
                'created_by_id' => $actor->id,
                'due_at' => $payload['due_at'] ?? null,
                'last_transitioned_at' => now(),
            ]);

            $this->transition($task, $actor, TaskTransitionAction::Created, null, $firstStep, 'Task created');
            $this->log($task, $actor, ActivityLogType::TaskCreated, 'created the task');
            $this->notifyOnAssignment($task, NotificationType::Assigned, 'New task assigned', 'You have been assigned to task '.$task->title.'.');

            return $this->freshTask($task);
        });
    }

    public function completeStep(Task $task, User $actor, ?string $notes = null): Task
    {
        $this->assertTaskAccess($task, $actor);

        return DB::transaction(function () use ($task, $actor, $notes): Task {
            $task->loadMissing('workflow.steps.team', 'currentStep');

            $steps = $task->workflow->steps->sortBy('sequence')->values();
            $currentStep = $task->currentStep ?? $steps->get($task->current_step_index);
            $nextStep = $steps->get($task->current_step_index + 1);

            if ($nextStep) {
                $task->forceFill([
                    'status' => TaskStatus::InProgress,
                    'current_workflow_step_id' => $nextStep->id,
                    'current_step_index' => $task->current_step_index + 1,
                    'assigned_team_id' => $nextStep->team_id,
                    'assigned_user_id' => null,
                    'last_transitioned_at' => now(),
                ])->save();

                $this->transition($task, $actor, TaskTransitionAction::Advanced, $currentStep, $nextStep, $notes);
                $this->log($task, $actor, ActivityLogType::StepCompleted, 'completed step: '.$currentStep?->name);
                $this->notifyStepTeam($task, $nextStep, NotificationType::Moved, 'Task moved forward', 'Task '.$task->title.' is ready for '.$nextStep->name.'.');
            } else {
                $task->forceFill([
                    'status' => TaskStatus::Completed,
                    'completed_at' => now(),
                    'last_transitioned_at' => now(),
                ])->save();

                $this->transition($task, $actor, TaskTransitionAction::Advanced, $currentStep, null, $notes);
                $this->log($task, $actor, ActivityLogType::StepCompleted, 'completed all steps');
                $this->notifyParticipants($task, NotificationType::Completed, 'Task completed', 'Task '.$task->title.' has been completed.');
            }

            return $this->freshTask($task);
        });
    }

    public function sendBack(Task $task, User $actor, ?string $reason = null, ?string $targetStepId = null): Task
    {
        $this->assertTaskAccess($task, $actor);

        return DB::transaction(function () use ($task, $actor, $reason, $targetStepId): Task {
            $task->loadMissing('workflow.steps.team', 'currentStep');

            $steps = $task->workflow->steps->sortBy('sequence')->values();
            $currentStep = $task->currentStep ?? $steps->get($task->current_step_index);

            $targetStep = $targetStepId
                ? $steps->firstWhere('id', $targetStepId)
                : $steps->get(max($task->current_step_index - 1, 0));

            if (! $targetStep || $targetStep->id === $currentStep?->id) {
                throw ValidationException::withMessages([
                    'targetStepId' => ['A valid previous workflow step is required.'],
                ]);
            }

            $task->forceFill([
                'status' => TaskStatus::InProgress,
                'current_workflow_step_id' => $targetStep->id,
                'current_step_index' => $steps->search(fn (WorkflowStep $step): bool => $step->id === $targetStep->id),
                'assigned_team_id' => $targetStep->team_id,
                'assigned_user_id' => null,
                'last_transitioned_at' => now(),
            ])->save();

            $this->transition($task, $actor, TaskTransitionAction::SentBack, $currentStep, $targetStep, $reason);
            $this->log($task, $actor, ActivityLogType::TaskMoved, 'sent the task back to '.$targetStep->name);
            $this->notifyStepTeam($task, $targetStep, NotificationType::Moved, 'Task sent back', 'Task '.$task->title.' was sent back to '.$targetStep->name.'.');

            return $this->freshTask($task);
        });
    }

    public function hold(Task $task, User $actor): Task
    {
        $this->assertTaskAccess($task, $actor);

        $task->forceFill([
            'status' => TaskStatus::OnHold,
            'last_transitioned_at' => now(),
        ])->save();

        $this->transition($task, $actor, TaskTransitionAction::Held, $task->currentStep, $task->currentStep, 'Task placed on hold');
        $this->log($task, $actor, ActivityLogType::TaskMoved, 'placed the task on hold');

        return $this->freshTask($task);
    }

    public function close(Task $task, User $actor): Task
    {
        $this->assertTaskAccess($task, $actor);

        $task->forceFill([
            'status' => TaskStatus::Closed,
            'closed_at' => now(),
            'last_transitioned_at' => now(),
        ])->save();

        $this->transition($task, $actor, TaskTransitionAction::Closed, $task->currentStep, null, 'Task closed');
        $this->log($task, $actor, ActivityLogType::TaskClosed, 'closed the task');
        $this->notifyParticipants($task, NotificationType::Completed, 'Task closed', 'Task '.$task->title.' has been closed.');

        return $this->freshTask($task);
    }

    public function addComment(Task $task, User $actor, string $content, bool $isInternal = false): TaskComment
    {
        $this->assertTaskAccess($task, $actor, $isInternal);

        return DB::transaction(function () use ($task, $actor, $content, $isInternal): TaskComment {
            $comment = $task->comments()->create([
                'user_id' => $actor->id,
                'content' => $content,
                'is_internal' => $isInternal,
            ]);

            $this->transition($task, $actor, TaskTransitionAction::Commented, $task->currentStep, $task->currentStep, $content);

            if (! $isInternal) {
                $this->log($task, $actor, ActivityLogType::CommentAdded, 'added a comment');
                $this->notifyParticipants($task, NotificationType::Comment, 'New task comment', $actor->name.' commented on '.$task->title.'.', [$actor->id]);
            }

            return $comment->load('user');
        });
    }

    private function transition(Task $task, User $actor, TaskTransitionAction $action, ?WorkflowStep $fromStep, ?WorkflowStep $toStep, ?string $notes = null): void
    {
        $task->transitions()->create([
            'actor_id' => $actor->id,
            'from_step_id' => $fromStep?->id,
            'to_step_id' => $toStep?->id,
            'action' => $action,
            'notes' => $notes,
            'created_at' => now(),
        ]);
    }

    private function log(Task $task, User $actor, ActivityLogType $type, string $description, array $meta = []): void
    {
        ActivityLog::query()->create([
            'task_id' => $task->id,
            'user_id' => $actor->id,
            'type' => $type,
            'description' => $description,
            'meta' => $meta,
            'created_at' => now(),
        ]);
    }

    private function notifyOnAssignment(Task $task, NotificationType $type, string $title, string $message): void
    {
        if ($task->assigned_user_id) {
            Notification::query()->create([
                'user_id' => $task->assigned_user_id,
                'task_id' => $task->id,
                'type' => $type,
                'title' => $title,
                'message' => $message,
            ]);

            return;
        }

        $this->notifyStepTeam($task, $task->currentStep, $type, $title, $message);
    }

    private function notifyParticipants(Task $task, NotificationType $type, string $title, string $message, array $exceptUserIds = []): void
    {
        $userIds = collect([$task->assigned_user_id, $task->created_by_id])
            ->filter()
            ->diff($exceptUserIds)
            ->unique()
            ->values();

        foreach ($userIds as $userId) {
            Notification::query()->create([
                'user_id' => $userId,
                'task_id' => $task->id,
                'type' => $type,
                'title' => $title,
                'message' => $message,
            ]);
        }
    }

    private function notifyStepTeam(Task $task, ?WorkflowStep $step, NotificationType $type, string $title, string $message): void
    {
        if (! $step?->team_id) {
            return;
        }

        User::query()
            ->where('team_id', $step->team_id)
            ->where('status', 'active')
            ->pluck('id')
            ->each(function (string $userId) use ($task, $type, $title, $message): void {
                Notification::query()->create([
                    'user_id' => $userId,
                    'task_id' => $task->id,
                    'type' => $type,
                    'title' => $title,
                    'message' => $message,
                ]);
            });
    }

    private function freshTask(Task $task): Task
    {
        return $task->fresh([
            'workflow.steps.team',
            'currentStep.team',
            'assignedTeam',
            'assignedUser',
            'createdBy',
            'comments.user',
            'attachments.uploadedBy',
            'activityLogs.user',
        ])->loadCount('comments');
    }

    private function assertTaskAccess(Task $task, User $actor, bool $requiresAdminForInternal = false): void
    {
        if ($actor->hasRole('admin')) {
            return;
        }

        if ($requiresAdminForInternal) {
            throw new AuthorizationException('Only administrators may add internal notes.');
        }

        if ($task->assigned_user_id !== $actor->id && $task->created_by_id !== $actor->id) {
            throw new AuthorizationException('You are not allowed to modify this task.');
        }
    }
}
