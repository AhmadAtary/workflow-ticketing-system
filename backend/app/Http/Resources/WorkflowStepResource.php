<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkflowStepResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'order' => $this->sequence,
            'teamId' => $this->team_id,
            'teamName' => $this->team?->name,
            'stepType' => $this->step_type?->value,
            'required' => (bool) $this->is_required,
        ];
    }
}
