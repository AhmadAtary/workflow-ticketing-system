<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->getRoleNames()->first(),
            'teamId' => $this->team_id,
            'teamName' => $this->team?->name,
            'avatar' => $this->avatar,
            'status' => $this->status?->value,
            'createdAt' => $this->created_at?->toIso8601String(),
            'lastLogin' => $this->last_login_at?->toIso8601String(),
        ];
    }
}
