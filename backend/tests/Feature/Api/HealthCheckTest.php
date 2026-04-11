<?php

it('returns a healthy api status payload', function () {
    $response = $this->getJson('/api/v1/healthz');

    $response
        ->assertOk()
        ->assertJsonPath('data.status', 'ok')
        ->assertJsonStructure([
            'data' => ['status', 'service', 'timestamp', 'environment'],
        ]);
});
