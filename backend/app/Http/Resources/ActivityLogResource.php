<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type?->value,
            'userId' => $this->user_id,
            'userName' => $this->user?->name,
            'userAvatar' => $this->user?->avatar,
            'taskId' => $this->task_id,
            'taskTitle' => $this->task?->title,
            'description' => $this->description,
            'createdAt' => $this->created_at?->toIso8601String(),
        ];
    }
}
