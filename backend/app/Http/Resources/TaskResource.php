<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $totalSteps = $this->workflow?->steps?->count() ?? $this->workflow?->steps()->count() ?? 0;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status?->value,
            'priority' => $this->priority?->value,
            'workflowId' => $this->workflow_id,
            'workflowName' => $this->workflow?->name,
            'currentStepId' => $this->current_workflow_step_id,
            'currentStepName' => $this->currentStep?->name,
            'currentStepIndex' => $this->current_step_index,
            'totalSteps' => $totalSteps,
            'assignedTeamId' => $this->assigned_team_id,
            'assignedTeamName' => $this->assignedTeam?->name,
            'assignedUserId' => $this->assigned_user_id,
            'assignedUserName' => $this->assignedUser?->name,
            'createdById' => $this->created_by_id,
            'createdByName' => $this->createdBy?->name,
            'dueDate' => $this->due_at?->toIso8601String(),
            'createdAt' => $this->created_at?->toIso8601String(),
            'updatedAt' => $this->updated_at?->toIso8601String(),
            'isOverdue' => $this->due_at?->isPast() && ! in_array($this->status?->value, ['completed', 'closed'], true),
            'commentCount' => $this->comments_count ?? $this->comments()->count(),
        ];
    }
}
