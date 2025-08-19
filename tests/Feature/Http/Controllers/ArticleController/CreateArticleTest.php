<?php

use App\Models\User;

it('can create a article', function() {
    $user = User::factory()->create();

    $response = $this->postJson('/api/articles', [
        'user_id' => $user->id,
        'title' => 'Last notice from the day',
        'content' => 'Lorem ipslum dolor amet'
    ]);

    $response
        ->assertStatus(201);

    $this->assertDatabaseHas('articles', [
        'title' => 'Last notice from the day'
    ]);

});