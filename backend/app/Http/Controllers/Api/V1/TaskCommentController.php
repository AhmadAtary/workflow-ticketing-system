<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Task\StoreTaskCommentRequest;
use App\Http\Resources\TaskCommentResource;
use App\Models\Task;
use App\Models\User;
use App\Services\Tasks\TaskLifecycleService;
use App\Support\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskCommentController extends Controller
{
    public function __construct(
        private readonly TaskLifecycleService $taskLifecycle,
    ) {}

    public function index(Request $request, Task $task): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();
        $this->authorizeView($task, $user);

        $comments = $task->comments()
            ->with('user')
            ->when(! $user->hasRole('admin'), fn ($query) => $query->where('is_internal', false))
            ->oldest('created_at')
            ->get();

        return ApiResponse::success(TaskCommentResource::collection($comments));
    }

    public function store(StoreTaskCommentRequest $request, Task $task): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        $comment = $this->taskLifecycle->addComment(
            $task,
            $user,
            $request->validated('content'),
            (bool) $request->boolean('isInternal'),
        );

        return ApiResponse::success(new TaskCommentResource($comment), 201);
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
