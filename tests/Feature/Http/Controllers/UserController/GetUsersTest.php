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
    Sanctum::actingAs($this->user);

    $response = $this->getJson('/api/users');

    $response->assertStatus(200);

    expect($response['data'])
        ->toBeArray();
});