<?php

namespace App\Services\Reports;

use App\Enums\TaskStatus;
use App\Models\ActivityLog;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Models\Workflow;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class DashboardReportService
{
    public function dashboardSummary(User $user): array
    {
        $query = $this->visibleTasksQuery($user);

        $tasks = $query->get(['id', 'status', 'priority', 'due_at', 'workflow_id']);
        $overdueTasks = $tasks->filter(fn (Task $task): bool => $task->due_at?->isPast() && ! in_array($task->status->value, [TaskStatus::Completed->value, TaskStatus::Closed->value], true));

        $tasksByStatus = $tasks->groupBy(fn (Task $task): string => $task->status->value)
            ->map(fn (Collection $items, string $status): array => ['status' => $status, 'count' => $items->count()])
            ->values()
            ->all();

        $tasksByPriority = $tasks->groupBy(fn (Task $task): string => $task->priority->value)
            ->map(fn (Collection $items, string $priority): array => ['priority' => $priority, 'count' => $items->count()])
            ->values()
            ->all();

        return [
            'totalTasks' => $tasks->count(),
            'openTasks' => $tasks->where('status', TaskStatus::Open)->count(),
            'inProgressTasks' => $tasks->where('status', TaskStatus::InProgress)->count(),
            'completedTasks' => $tasks->where('status', TaskStatus::Completed)->count(),
            'overdueTasks' => $overdueTasks->count(),
            'pendingApprovals' => Task::query()
                ->whereHas('currentStep', fn (Builder $builder) => $builder->where('step_type', 'approval'))
                ->tap(fn (Builder $builder) => $this->applyVisibility($builder, $user))
                ->count(),
            'totalTeams' => Team::query()->count(),
            'totalUsers' => User::query()->count(),
            'totalWorkflows' => Workflow::query()->count(),
            'tasksByStatus' => $tasksByStatus,
            'tasksByPriority' => $tasksByPriority,
        ];
    }

    public function taskStats(): array
    {
        $tasks = Task::query()->with(['assignedTeam:id,name', 'workflow:id,name'])->get();

        return [
            'byStatus' => $tasks->groupBy(fn (Task $task): string => $task->status->value)
                ->map(fn (Collection $items, string $status): array => ['status' => $status, 'count' => $items->count()])
                ->values()
                ->all(),
            'byTeam' => $tasks->groupBy(fn (Task $task): string => $task->assignedTeam?->id ?? 'unassigned')
                ->map(fn (Collection $items): array => [
                    'teamId' => $items->first()->assignedTeam?->id ?? '',
                    'teamName' => $items->first()->assignedTeam?->name ?? 'Unassigned',
                    'count' => $items->count(),
                ])
                ->values()
                ->all(),
            'byWorkflow' => $tasks->groupBy(fn (Task $task): string => $task->workflow_id)
                ->map(fn (Collection $items): array => [
                    'workflowId' => $items->first()->workflow?->id ?? '',
                    'workflowName' => $items->first()->workflow?->name ?? 'Unknown',
                    'count' => $items->count(),
                ])
                ->values()
                ->all(),
            'completionTrend' => $this->completionTrend($tasks),
        ];
    }

    public function teamPerformance(string $period = '30d'): array
    {
        $startDate = $this->periodStart($period);

        return Team::query()
            ->with(['users', 'tasks'])
            ->get()
            ->map(function (Team $team) use ($startDate): array {
                $tasks = $team->tasks->filter(fn (Task $task): bool => $task->created_at->gte($startDate));
                $completed = $tasks->where('status', TaskStatus::Completed);

                $averageCompletionHours = $completed->isEmpty()
                    ? 0
                    : round($completed->avg(fn (Task $task): float => (float) optional($task->completed_at)->diffInHours($task->created_at)), 2);

                return [
                    'teamId' => $team->id,
                    'teamName' => $team->name,
                    'tasksCompleted' => $completed->count(),
                    'tasksOverdue' => $tasks->filter(fn (Task $task): bool => $task->due_at?->isPast() && ! in_array($task->status->value, [TaskStatus::Completed->value, TaskStatus::Closed->value], true))->count(),
                    'avgCompletionTime' => $averageCompletionHours,
                    'activeMembers' => $team->users->where('status', 'active')->count(),
                ];
            })
            ->values()
            ->all();
    }

    public function workflowBottlenecks(): array
    {
        return Task::query()
            ->with(['workflow:id,name', 'currentStep:id,name'])
            ->whereIn('status', [TaskStatus::Open, TaskStatus::InProgress, TaskStatus::OnHold])
            ->get()
            ->groupBy(fn (Task $task): string => $task->workflow_id.'|'.$task->current_workflow_step_id)
            ->map(function (Collection $tasks): array {
                /** @var Task $first */
                $first = $tasks->first();

                return [
                    'workflowId' => $first->workflow?->id ?? '',
                    'workflowName' => $first->workflow?->name ?? 'Unknown',
                    'stepId' => $first->currentStep?->id ?? '',
                    'stepName' => $first->currentStep?->name ?? 'Unassigned',
                    'avgTimeInStep' => round($tasks->avg(fn (Task $task): float => (float) now()->diffInHours($task->last_transitioned_at ?? $task->created_at)), 2),
                    'pendingCount' => $tasks->count(),
                ];
            })
            ->values()
            ->all();
    }

    public function activityFeed(int $perPage = 20): LengthAwarePaginator
    {
        return ActivityLog::query()
            ->with(['user', 'task'])
            ->latest('created_at')
            ->paginate($perPage);
    }

    private function completionTrend(Collection $tasks): array
    {
        return collect(range(0, 13))
            ->map(function (int $offset) use ($tasks): array {
                $date = now()->subDays(13 - $offset)->startOfDay();
                $formatted = $date->format('Y-m-d');

                return [
                    'date' => $formatted,
                    'completed' => $tasks->filter(fn (Task $task): bool => $task->completed_at?->isSameDay($date))->count(),
                    'created' => $tasks->filter(fn (Task $task): bool => $task->created_at->isSameDay($date))->count(),
                ];
            })
            ->all();
    }

    private function visibleTasksQuery(User $user): Builder
    {
        return $this->applyVisibility(Task::query(), $user);
    }

    private function applyVisibility(Builder $query, User $user): Builder
    {
        if ($user->hasRole('admin')) {
            return $query;
        }

        return $query->where(function (Builder $builder) use ($user): void {
            $builder
                ->where('assigned_user_id', $user->id)
                ->orWhere('created_by_id', $user->id);
        });
    }

    private function periodStart(string $period): Carbon
    {
        return match ($period) {
            '7d' => now()->subDays(7),
            '90d' => now()->subDays(90),
            default => now()->subDays(30),
        };
    }
}
