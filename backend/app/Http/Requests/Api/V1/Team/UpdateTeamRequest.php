<?php

namespace App\Http\Requests\Api\V1\Team;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeamRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('teams', 'name')->ignore($this->route('team')?->id)],
            'description' => ['nullable', 'string'],
            'color' => ['nullable', 'string', 'max:16'],
        ];
    }
}
