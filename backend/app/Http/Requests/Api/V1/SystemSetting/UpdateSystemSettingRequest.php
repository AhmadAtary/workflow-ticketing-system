<?php

namespace App\Http\Requests\Api\V1\SystemSetting;

use App\Enums\SystemLanguage;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSystemSettingRequest extends FormRequest
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
            'companyName' => ['sometimes', 'required', 'string', 'max:255'],
            'logoUrl' => ['nullable', 'url'],
            'primaryColor' => ['nullable', 'string', 'max:16'],
            'defaultLanguage' => ['sometimes', 'required', Rule::enum(SystemLanguage::class)],
            'emailHost' => ['nullable', 'string', 'max:255'],
            'emailPort' => ['nullable', 'integer', 'min:1', 'max:65535'],
            'emailFrom' => ['nullable', 'email'],
            'emailUser' => ['nullable', 'string', 'max:255'],
            'emailPassword' => ['nullable', 'string'],
            'emailEnabled' => ['nullable', 'boolean'],
            'allowRegistration' => ['nullable', 'boolean'],
            'requireEmailVerification' => ['nullable', 'boolean'],
        ];
    }
}
