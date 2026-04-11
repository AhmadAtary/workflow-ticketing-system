<?php

namespace App\Services\Auth;

use App\Enums\ActivityLogType;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\JWTGuard;
use Symfony\Component\HttpFoundation\Cookie;

class AuthService
{
    public function __construct(
        private readonly RefreshTokenService $refreshTokens,
    ) {}

    public function login(array $credentials, Request $request): array
    {
        /** @var JWTGuard $guard */
        $guard = Auth::guard('api');
        $token = $guard->attempt($credentials);

        if (! $token) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are invalid.'],
            ]);
        }

        /** @var User $user */
        $user = $guard->user();
        $user->forceFill([
            'last_login_at' => now(),
        ])->save();

        ActivityLog::query()->create([
            'user_id' => $user->id,
            'type' => ActivityLogType::UserLoggedIn,
            'description' => 'signed in',
            'created_at' => now(),
        ]);

        [$refreshToken] = $this->refreshTokens->issue($user, $request);

        return [
            'user' => $user->fresh(['team', 'roles']),
            'access_token' => $token,
            'cookie' => $this->refreshTokens->makeCookie($refreshToken),
            'expires_in' => $guard->factory()->getTTL() * 60,
        ];
    }

    public function refresh(Request $request): array
    {
        /** @var JWTGuard $guard */
        $guard = Auth::guard('api');
        $plainTextToken = $request->cookie((string) config('auth.refresh_tokens.cookie_name', 'flowdesk_refresh'));

        if (! $plainTextToken) {
            throw new AuthenticationException('A refresh token cookie is required.');
        }

        [$user, $replacementToken] = $this->refreshTokens->rotate($plainTextToken, $request);

        $token = $guard->login($user);

        return [
            'user' => $user->fresh(['team', 'roles']),
            'access_token' => $token,
            'cookie' => $this->refreshTokens->makeCookie($replacementToken),
            'expires_in' => $guard->factory()->getTTL() * 60,
        ];
    }

    public function logout(Request $request): Cookie
    {
        /** @var JWTGuard $guard */
        $guard = Auth::guard('api');
        $this->refreshTokens->revoke($request->cookie((string) config('auth.refresh_tokens.cookie_name', 'flowdesk_refresh')));

        try {
            if ($guard->check()) {
                $guard->logout(true);
            }
        } catch (\Throwable) {
            // Ignore invalid or already expired access tokens on logout.
        }

        return $this->refreshTokens->forgetCookie();
    }
}
