<?php

namespace App\Http\Requests\Api\V1\EmailTemplate;

use App\Enums\EmailTemplateTrigger;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmailTemplateRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('email_templates', 'name')->ignore($this->route('email_template')?->id)],
            'subject' => ['sometimes', 'required', 'string', 'max:255'],
            'body' => ['sometimes', 'required', 'string'],
            'trigger' => ['sometimes', 'required', Rule::enum(EmailTemplateTrigger::class)],
            'variables' => ['nullable', 'array'],
            'variables.*' => ['string', 'max:255'],
            'isActive' => ['nullable', 'boolean'],
        ];
    }
}
