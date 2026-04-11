<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Task\CompleteTaskStepRequest;
use App\Http\Requests\Api\V1\Task\SendBackTaskRequest;
use App\Http\Resources\TaskDetailResource;
use App\Models\Task;
use App\Models\User;
use App\Services\Tasks\TaskLifecycleService;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskLifecycleController extends Controller
{
    public function __construct(
        private readonly TaskLifecycleService $taskLifecycle,
    ) {}

    public function completeStep(CompleteTaskStepRequest $request, Task $task): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        $task = $this->taskLifecycle->completeStep(
            $task,
            $user,
            $request->validated('notes'),
        );

        return ApiResponse::success(new TaskDetailResource($task));
    }

    public function sendBack(SendBackTaskRequest $request, Task $task): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        $task = $this->taskLifecycle->sendBack(
            $task,
            $user,
            $request->validated('reason'),
            $request->validated('targetStepId'),
        );

        return ApiResponse::success(new TaskDetailResource($task));
    }

    public function hold(Request $request, Task $task): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        return ApiResponse::success(new TaskDetailResource($this->taskLifecycle->hold($task, $user)));
    }

    public function close(Request $request, Task $task): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        return ApiResponse::success(new TaskDetailResource($this->taskLifecycle->close($task, $user)));
    }
}
