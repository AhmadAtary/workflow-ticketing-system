<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SystemSettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'companyName' => $this->company_name,
            'logoUrl' => $this->logo_url,
            'primaryColor' => $this->primary_color,
            'defaultLanguage' => $this->default_language?->value,
            'emailHost' => $this->email_host,
            'emailPort' => $this->email_port,
            'emailFrom' => $this->email_from,
            'emailUser' => $this->email_user,
            'emailEnabled' => (bool) $this->email_enabled,
            'allowRegistration' => (bool) $this->allow_registration,
            'requireEmailVerification' => (bool) $this->require_email_verification,
        ];
    }
}
