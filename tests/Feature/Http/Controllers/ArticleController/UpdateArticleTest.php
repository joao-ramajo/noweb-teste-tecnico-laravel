<?php

use App\Models\Article;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function(){
    $this->userA = User::factory()->create();
    $this->userB = User::factory()->create();

    $this->article = Article::factory()->create([
        'user_id' => $this->userA->id
    ]);
});

it('can update a article', function() {
    Sanctum::actingAs($this->userA);
    $article = $this->article;

    $response = $this->putJson("/api/articles/{$article->id}", [
        'title' => 'new title',
        'content' => 'new content'
    ]);

    $response
        ->assertStatus(200);

    $this->assertDatabaseHas('articles',[
        'title' => 'new title',
        'content' => 'new content',
    ]);
});

it('denies a update from other users', function() {
    Sanctum::actingAs($this->userB);

    $response = $this->putJson("/api/articles/{$this->article->id}", [
        'title' => 'new title',
        'content' => 'new content'
    ]);

    $response
        ->assertStatus(403);
});