<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Enums\SystemLanguage;
use App\Enums\UserStatus;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $name = (string) env('FLOWDESK_ADMIN_NAME', 'Atary');
        $email = (string) env('FLOWDESK_ADMIN_EMAIL', 'atary.avxav@gmail.com');
        $password = (string) env('FLOWDESK_ADMIN_PASSWORD', 'Atary@2912');

        $user = User::withTrashed()->firstWhere('email', $email);

        if ($user === null) {
            $user = new User();
            $user->email = $email;
        } elseif ($user->trashed()) {
            $user->restore();
        }

        $user->fill([
            'name' => $name,
            'password' => $password,
            'status' => UserStatus::Active->value,
            'team_id' => null,
            'last_login_at' => null,
        ]);
        $user->email_verified_at = now();
        $user->save();

        $user->syncRoles([RoleName::Admin->value]);

        if (! SystemSetting::query()->exists()) {
            SystemSetting::query()->create([
                'company_name' => 'FlowDesk',
                'primary_color' => '#0F172A',
                'default_language' => SystemLanguage::English,
                'email_host' => 'mailhog',
                'email_port' => 1025,
                'email_from' => 'noreply@flowdesk.test',
                'email_user' => 'flowdesk',
                'email_password' => 'secret',
                'email_enabled' => true,
                'allow_registration' => false,
                'require_email_verification' => true,
            ]);
        }
    }
}
