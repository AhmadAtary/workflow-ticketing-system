<?php

namespace App\Services\Auth;

use App\Models\RefreshToken;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Cookie;

class RefreshTokenService
{
    public function issue(User $user, Request $request): array
    {
        $plainTextToken = Str::random(96);

        $token = $user->refreshTokens()->create([
            'token_hash' => hash('sha256', $plainTextToken),
            'user_agent' => Str::limit((string) $request->userAgent(), 1024, ''),
            'ip_address' => $request->ip(),
            'last_used_at' => now(),
            'expires_at' => now()->addDays($this->ttlDays()),
        ]);

        return [$plainTextToken, $token];
    }

    public function rotate(string $plainTextToken, Request $request): array
    {
        $refreshToken = RefreshToken::query()
            ->with('user.roles')
            ->where('token_hash', hash('sha256', $plainTextToken))
            ->whereNull('revoked_at')
            ->where('expires_at', '>', now())
            ->first();

        if (! $refreshToken) {
            throw new AuthenticationException('The refresh token is invalid or expired.');
        }

        $refreshToken->forceFill([
            'last_used_at' => now(),
            'revoked_at' => now(),
        ])->save();

        [$replacement] = $this->issue($refreshToken->user, $request);

        return [$refreshToken->user, $replacement];
    }

    public function revoke(?string $plainTextToken): void
    {
        if (! $plainTextToken) {
            return;
        }

        RefreshToken::query()
            ->where('token_hash', hash('sha256', $plainTextToken))
            ->whereNull('revoked_at')
            ->update([
                'revoked_at' => now(),
                'last_used_at' => now(),
            ]);
    }

    public function makeCookie(string $plainTextToken): Cookie
    {
        return cookie(
            $this->cookieName(),
            $plainTextToken,
            $this->ttlDays() * 24 * 60,
            '/',
            null,
            app()->environment('production'),
            true,
            false,
            'lax',
        );
    }

    public function forgetCookie(): Cookie
    {
        return cookie()->forget(
            $this->cookieName(),
            '/',
            null,
        );
    }

    private function ttlDays(): int
    {
        return (int) config('auth.refresh_tokens.ttl_days', 14);
    }

    private function cookieName(): string
    {
        return (string) config('auth.refresh_tokens.cookie_name', 'flowdesk_refresh');
    }
}
