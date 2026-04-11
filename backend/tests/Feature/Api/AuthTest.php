<?php

use Database\Seeders\DatabaseSeeder;

beforeEach(function (): void {
    $this->seed(DatabaseSeeder::class);
});

it('logs in with seeded credentials and returns the authenticated user payload', function () {
    $response = $this->postJson('/api/v1/auth/login', [
        'email' => 'admin@flowdesk.test',
        'password' => 'Password123!',
    ]);

    $response
        ->assertOk()
        ->assertJsonPath('data.user.email', 'admin@flowdesk.test')
        ->assertJsonPath('data.token_type', 'Bearer')
        ->assertJsonStructure([
            'data' => [
                'user' => ['id', 'name', 'email', 'role'],
                'access_token',
                'token_type',
                'expires_in',
            ],
        ]);
});
