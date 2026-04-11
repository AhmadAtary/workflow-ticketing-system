<?php

use Database\Seeders\DatabaseSeeder;

beforeEach(function (): void {
    $this->seed(DatabaseSeeder::class);
});

it('lists tasks visible to an authenticated standard user', function () {
    $login = $this->postJson('/api/v1/auth/login', [
        'email' => 'operations@flowdesk.test',
        'password' => 'Password123!',
    ])->assertOk();

    $token = $login->json('data.access_token');

    $response = $this
        ->withHeader('Authorization', 'Bearer '.$token)
        ->getJson('/api/v1/tasks');

    $response
        ->assertOk()
        ->assertJsonStructure([
            'data',
            'meta' => ['page', 'per_page', 'total'],
        ]);

    expect($response->json('data'))->not->toBeEmpty();
});
