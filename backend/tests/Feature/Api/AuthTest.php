<?php

use Database\Seeders\DatabaseSeeder;

beforeEach(function (): void {
    $this->seed(DatabaseSeeder::class);
});

it('logs in with seeded credentials and returns the authenticated user payload', function () {
    $response = $this->postJson('/api/v1/auth/login', [
        'email' => 'atary.avxav@gmail.com',
        'password' => 'Atary@2912',
    ]);

    $response
        ->assertOk()
        ->assertJsonPath('data.user.email', 'atary.avxav@gmail.com')
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
