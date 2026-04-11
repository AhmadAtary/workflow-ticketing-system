<?php

namespace App\Models;

use App\Enums\SystemLanguage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'company_name',
        'logo_url',
        'primary_color',
        'default_language',
        'email_host',
        'email_port',
        'email_from',
        'email_user',
        'email_password',
        'email_enabled',
        'allow_registration',
        'require_email_verification',
    ];

    protected function casts(): array
    {
        return [
            'default_language' => SystemLanguage::class,
            'email_enabled' => 'boolean',
            'allow_registration' => 'boolean',
            'require_email_verification' => 'boolean',
        ];
    }
}
