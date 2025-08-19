<?php

it('can create a user', function () {
    $response = $this->postJson('/api/users',[
        'nadme' => 'João',
        'email' => 'joao',
        'password' => 'joao',
        'password_confirm' => 'joao'
    ]);

    // var_dump( $response);
    $response->assertStatus(201);

});
