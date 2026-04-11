<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\TaskStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Task\StoreTaskRequest;
use App\Http\Requests\Api\V1\Task\UpdateTaskRequest;
use App\Http\Resources\TaskDetailResource;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use App\Models\Workflow;
use App\Models\WorkflowStep;
use App\Services\Tasks\TaskLifecycleService;
use App\Support\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskLifecycleService $taskLifecycle,
    ) {}

    public function index(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        $paginator = Task::query()
            ->with([
                'workflow.steps',
                'currentStep.team',
                'assignedTeam',
                'assignedUser',
                'createdBy',
            ])
            ->withCount('comments')
            ->when(! $user->hasRole('admin'), function (Builder $query) use ($user): void {
                $query->where(function (Builder $builder) use ($user): void {
                    $builder
                        ->where('assigned_user_id', $user->id)
                        ->orWhere('created_by_id', $user->id);
                });
            })
            ->when($request->string('search')->toString(), function (Builder $query, string $search): void {
                $query->where(function (Builder $builder) use ($search): void {
                    $builder
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), fn (Builder $query) => $query->where('status', $request->string('status')->toString()))
            ->when($request->filled('priority'), fn (Builder $query) => $query->where('priority', $request->string('priority')->toString()))
            ->when($request->filled('workflowId'), fn (Builder $query) => $query->where('workflow_id', $request->string('workflowId')->toString()))
            ->when($request->filled('assignedTeamId'), fn (Builder $query) => $query->where('assigned_team_id', $request->string('assignedTeamId')->toString()))
            ->when($request->filled('assignedUserId'), fn (Builder $query) => $query->where('assigned_user_id', $request->string('assignedUserId')->toString()))
            ->when($request->boolean('overdue'), function (Builder $query): void {
                $query
                    ->whereNotNull('due_at')
                    ->where('due_at', '<', now())
                    ->whereNotIn('status', [TaskStatus::Completed->value, TaskStatus::Closed->value]);
            })
            ->latest('created_at')
            ->paginate((int) $request->integer('perPage', 15));

        return ApiResponse::paginated($paginator, TaskResource::collection($paginator->getCollection()));
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        $task = $this->taskLifecycle->createTask([
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'priority' => $request->validated('priority'),
            'workflow_id' => $request->validated('workflowId'),
            'assigned_user_id' => $request->validated('assignedUserId'),
            'due_at' => $request->validated('dueDate'),
        ], $user);

        return ApiResponse::success(new TaskDetailResource($task), Response::HTTP_CREATED);
    }

    public function show(Request $request, Task $task): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();
        $this->authorizeView($task, $user);

        return ApiResponse::success(new TaskDetailResource($this->loadDetail($task, $user)));
    }

    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $payload = $request->validated();

        $task = DB::transaction(function () use ($payload, $task): Task {
            $updates = [];

            if (array_key_exists('title', $payload)) {
                $updates['title'] = $payload['title'];
            }

            if (array_key_exists('description', $payload)) {
                $updates['description'] = $payload['description'];
            }

            if (array_key_exists('priority', $payload)) {
                $updates['priority'] = $payload['priority'];
            }

            if (array_key_exists('assignedUserId', $payload)) {
                $updates['assigned_user_id'] = $payload['assignedUserId'];
            }

            if (array_key_exists('dueDate', $payload)) {
                $updates['due_at'] = $payload['dueDate'];
            }

            if (array_key_exists('status', $payload)) {
                $updates['status'] = $payload['status'];
                $updates['started_at'] = $payload['status'] === TaskStatus::InProgress->value && ! $task->started_at ? now() : $task->started_at;
                $updates['completed_at'] = $payload['status'] === TaskStatus::Completed->value ? now() : $task->completed_at;
                $updates['closed_at'] = $payload['status'] === TaskStatus::Closed->value ? now() : $task->closed_at;
            }

            if (array_key_exists('workflowId', $payload) && $payload['workflowId'] !== $task->workflow_id) {
                $workflow = Workflow::query()->with('steps.team')->findOrFail($payload['workflowId']);
                /** @var WorkflowStep|null $firstStep */
                $firstStep = $workflow->steps->sortBy('sequence')->first();

                if (! $firstStep) {
                    throw ValidationException::withMessages([
                        'workflowId' => ['The selected workflow must contain at least one step.'],
                    ]);
                }

                $updates['workflow_id'] = $workflow->id;
                $updates['current_workflow_step_id'] = $firstStep->id;
                $updates['current_step_index'] = 0;
                $updates['assigned_team_id'] = $firstStep->team_id;
            }

            if ($updates !== []) {
                $updates['last_transitioned_at'] = now();
                $task->update($updates);
            }

            return $task->fresh();
        });

        return ApiResponse::success(new TaskDetailResource($this->loadDetail($task, $request->user())));
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return ApiResponse::noContent();
    }

    private function loadDetail(Task $task, User $user): Task
    {
        $task->load([
            'workflow.steps.team',
            'currentStep.team',
            'assignedTeam',
            'assignedUser',
            'createdBy',
            'comments.user',
            'attachments.uploadedBy',
            'activityLogs.user',
        ])->loadCount('comments');

        if (! $user->hasRole('admin')) {
            $task->setRelation(
                'comments',
                $task->comments->where('is_internal', false)->values(),
            );
        }

        return $task;
    }

    private function authorizeView(Task $task, User $user): void
    {
        if ($user->hasRole('admin')) {
            return;
        }

        if ($task->assigned_user_id !== $user->id && $task->created_by_id !== $user->id) {
            throw new AuthorizationException('You are not allowed to view this task.');
        }
    }
}
