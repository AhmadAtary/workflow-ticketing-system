<?php

namespace App\Http\Requests\Api\V1\EmailTemplate;

use App\Enums\EmailTemplateTrigger;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmailTemplateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:email_templates,name'],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'trigger' => ['required', Rule::enum(EmailTemplateTrigger::class)],
            'variables' => ['nullable', 'array'],
            'variables.*' => ['string', 'max:255'],
            'isActive' => ['nullable', 'boolean'],
        ];
    }
}
