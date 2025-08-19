<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

beforeEach(function() {
    User::create([
        'name' => 'joão',
        'email' => 'joao@gmail.com',
        'password' => Hash::make('Aa123123')
    ]);
});

it('can login with success', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'joao@gmail.com',
        'password' => 'Aa123123'
    ]);

    $response->assertStatus(200);

    expect($response['token'])
        ->toBeString();
});

it('denies access with invalid request data', function() {
    $response = $this->postJson('/api/login', [
        'email' => 'gmail.com',
        'password' => 'Ab123123'
    ]);

    $response
        ->assertStatus(422);
});

it('denies access from invalid password', function() {
    $response = $this->postJson('/api/login', [
        'email' => 'joao@gmail.com',
        'password' => 'Bb123123'
    ]);

    $response
        ->assertStatus(401);
});