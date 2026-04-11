<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return array_merge((new TaskResource($this->resource))->toArray($request), [
            'workflow' => new WorkflowResource($this->whenLoaded('workflow')),
            'comments' => TaskCommentResource::collection($this->whenLoaded('comments', fn () => $this->comments->where('is_internal', false)->values())),
            'activityLog' => ActivityLogResource::collection($this->whenLoaded('activityLogs')),
            'attachments' => TaskAttachmentResource::collection($this->whenLoaded('attachments')),
            'internalNotes' => TaskCommentResource::collection($this->whenLoaded('comments', fn () => $this->comments->where('is_internal', true)->values())),
        ]);
    }
}
