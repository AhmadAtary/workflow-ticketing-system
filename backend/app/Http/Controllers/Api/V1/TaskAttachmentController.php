<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskAttachmentResource;
use App\Models\Task;
use App\Models\TaskAttachment;
use App\Models\User;
use App\Support\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class TaskAttachmentController extends Controller
{
    public function store(Request $request, Task $task): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();
        $this->authorizeTaskAccess($task, $user);

        $payload = $request->validate([
            'file' => ['required', 'file', 'max:10240'],
        ]);

        $disk = (string) config('filesystems.attachments_disk', 'attachments');
        $path = $payload['file']->store("tasks/{$task->id}", $disk);

        $attachment = $task->attachments()->create([
            'uploaded_by_id' => $user->id,
            'disk' => $disk,
            'path' => $path,
            'original_name' => $payload['file']->getClientOriginalName(),
            'mime_type' => $payload['file']->getClientMimeType(),
            'size' => $payload['file']->getSize(),
        ]);

        return ApiResponse::success(
            new TaskAttachmentResource($attachment->load('uploadedBy')),
            Response::HTTP_CREATED,
        );
    }

    public function destroy(Request $request, Task $task, TaskAttachment $attachment): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();
        $this->authorizeTaskAccess($task, $user);

        abort_unless($attachment->task_id === $task->id, Response::HTTP_NOT_FOUND);

        Storage::disk($attachment->disk)->delete($attachment->path);
        $attachment->delete();

        return ApiResponse::noContent();
    }

    private function authorizeTaskAccess(Task $task, User $user): void
    {
        if ($user->hasRole('admin')) {
            return;
        }

        if ($task->assigned_user_id !== $user->id && $task->created_by_id !== $user->id) {
            throw new AuthorizationException('You are not allowed to modify this task.');
        }
    }
}
