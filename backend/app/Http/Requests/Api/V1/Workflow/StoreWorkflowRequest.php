<?php

namespace App\Http\Requests\Api\V1\Workflow;

use App\Enums\WorkflowStatus;
use App\Enums\WorkflowStepType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWorkflowRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', Rule::enum(WorkflowStatus::class)],
            'steps' => ['required', 'array', 'min:1'],
            'steps.*.id' => ['nullable', 'string'],
            'steps.*.name' => ['required', 'string', 'max:255'],
            'steps.*.description' => ['nullable', 'string'],
            'steps.*.teamId' => ['nullable', 'exists:teams,id'],
            'steps.*.stepType' => ['required', Rule::enum(WorkflowStepType::class)],
            'steps.*.required' => ['nullable', 'boolean'],
        ];
    }
}
