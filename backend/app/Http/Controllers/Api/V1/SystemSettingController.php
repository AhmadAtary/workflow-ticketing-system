<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\SystemLanguage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SystemSetting\UpdateSystemSettingRequest;
use App\Http\Resources\SystemSettingResource;
use App\Models\SystemSetting;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;

class SystemSettingController extends Controller
{
    public function show(): JsonResponse
    {
        return ApiResponse::success(new SystemSettingResource($this->settings()));
    }

    public function update(UpdateSystemSettingRequest $request): JsonResponse
    {
        $settings = $this->settings();
        $payload = $request->validated();

        $settings->update([
            'company_name' => $payload['companyName'] ?? $settings->company_name,
            'logo_url' => array_key_exists('logoUrl', $payload) ? $payload['logoUrl'] : $settings->logo_url,
            'primary_color' => array_key_exists('primaryColor', $payload) ? $payload['primaryColor'] : $settings->primary_color,
            'default_language' => $payload['defaultLanguage'] ?? $settings->default_language,
            'email_host' => array_key_exists('emailHost', $payload) ? $payload['emailHost'] : $settings->email_host,
            'email_port' => array_key_exists('emailPort', $payload) ? $payload['emailPort'] : $settings->email_port,
            'email_from' => array_key_exists('emailFrom', $payload) ? $payload['emailFrom'] : $settings->email_from,
            'email_user' => array_key_exists('emailUser', $payload) ? $payload['emailUser'] : $settings->email_user,
            'email_password' => array_key_exists('emailPassword', $payload) ? $payload['emailPassword'] : $settings->email_password,
            'email_enabled' => array_key_exists('emailEnabled', $payload) ? (bool) $payload['emailEnabled'] : $settings->email_enabled,
            'allow_registration' => array_key_exists('allowRegistration', $payload) ? (bool) $payload['allowRegistration'] : $settings->allow_registration,
            'require_email_verification' => array_key_exists('requireEmailVerification', $payload) ? (bool) $payload['requireEmailVerification'] : $settings->require_email_verification,
        ]);

        return ApiResponse::success(new SystemSettingResource($settings->fresh()));
    }

    private function settings(): SystemSetting
    {
        return SystemSetting::query()->first() ?? SystemSetting::query()->create([
            'company_name' => 'FlowDesk',
            'default_language' => SystemLanguage::English,
            'email_enabled' => false,
            'allow_registration' => false,
            'require_email_verification' => true,
        ]);
    }
}
