<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'type' => $this->type?->value,
            'title' => $this->title,
            'message' => $this->message,
            'taskId' => $this->task_id,
            'taskTitle' => $this->task?->title,
            'isRead' => $this->read_at !== null,
            'createdAt' => $this->created_at?->toIso8601String(),
        ];
    }
}
