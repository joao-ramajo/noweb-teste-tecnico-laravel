<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('can create a article', function() {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/articles', [
        'title' => 'Last notice from the day',
        'content' => 'Lorem ipslum dolor amet'
    ]);

    $response
        ->assertStatus(201);

    $this->assertDatabaseHas('articles', [
        'title' => 'Last notice from the day',
        'user_id' => $user->id
    ]);

});

it('denies access from without token', function() {
    $response = $this->postJson('/api/articles', [
        'title' => 'Last notice from the day',
        'content' => 'Lorem ipslum dolor amet'
    ]);

    $response
        ->assertStatus(401);
});