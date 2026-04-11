<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskCommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'taskId' => $this->task_id,
            'userId' => $this->user_id,
            'userName' => $this->user?->name,
            'userAvatar' => $this->user?->avatar,
            'content' => $this->content,
            'isInternal' => (bool) $this->is_internal,
            'createdAt' => $this->created_at?->toIso8601String(),
        ];
    }
}
