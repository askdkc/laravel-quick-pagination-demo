<?php

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('welcome page links to pagination comparison pages', function () {
    $this->get(route('home'))
        ->assertSuccessful()
        ->assertSee('Normal pagination')
        ->assertSee('Quick pagination')
        ->assertSee(route('posts.pagination.normal'), false)
        ->assertSee(route('posts.pagination.quick'), false);
});

test('normal pagination page displays posts', function () {
    Post::factory()->count(75)->create();

    $this->get(route('posts.pagination.normal'))
        ->assertSuccessful()
        ->assertSee('Normal pagination')
        ->assertSee('Benchmark results')
        ->assertSee('Quick pagination');
});

test('quick pagination page displays posts', function () {
    Post::factory()->count(75)->create();

    $this->get(route('posts.pagination.quick'))
        ->assertSuccessful()
        ->assertSee('Quick pagination')
        ->assertSee('Benchmark results')
        ->assertSee('Normal pagination');
});
