<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

beforeEach(function() {
    $this->user = User::create([
        'name' => 'joao',
        'email' => 'joao@gmail.com',
        'password' => Hash::make('Aa123123')
    ]);
});

it('denied access from unauthorized access', function() {
    $response = $this->getJson('/api/users');

    $response->assertStatus(401);
});

it('has return a list of users', function() {
    User::factory()->count(3)->create();

    Sanctum::actingAs($this->user);

    $response = $this->getJson('/api/users');

    $response->assertStatus(200);

    $response
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'email'],
            ],
            'links',
        ])
        ->assertJsonCount(4, 'data');
});