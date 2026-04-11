<?php

namespace App\Http\Requests\Api\V1\Workflow;

use App\Enums\WorkflowStatus;
use App\Enums\WorkflowStepType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWorkflowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['sometimes', 'required', Rule::enum(WorkflowStatus::class)],
            'steps' => ['sometimes', 'required', 'array', 'min:1'],
            'steps.*.id' => ['nullable', 'string'],
            'steps.*.name' => ['required_with:steps', 'string', 'max:255'],
            'steps.*.description' => ['nullable', 'string'],
            'steps.*.teamId' => ['nullable', 'exists:teams,id'],
            'steps.*.stepType' => ['required_with:steps', Rule::enum(WorkflowStepType::class)],
            'steps.*.required' => ['nullable', 'boolean'],
        ];
    }
}
