<?php

it('can create a user', function () {
    $response = $this->postJson('/api/users',[
        'name' => 'João Ramajo',
        'email' => 'joao@gmail.com',
        'password' => 'Aa123123',
        'password_confirmation' => 'Aa123123'
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('users',[
        'email' => 'joao@gmail.com'
    ]);
});