<?php

use Database\Seeders\DatabaseSeeder;

beforeEach(function (): void {
    $this->seed(DatabaseSeeder::class);
});

it('lists tasks for an authenticated admin user', function () {
    $login = $this->postJson('/api/v1/auth/login', [
        'email' => 'atary.avxav@gmail.com',
        'password' => 'Atary@2912',
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

    expect($response->json('data'))->toBeArray();
});
