<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_articles()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.articles.store'), [
            'data' => [
                'type' => 'article',
                'attributes' => [
                    'title' => 'Nuevo article',
                    'slug' => 'nuevo article',
                    'content' => 'contenido del article'
                ]
            ]
        ]);

        // Pasamos el estado 201
        $response->assertCreated();

        $article = Article::first();

        // Headers como lo especifica JSONAPI
        $response->assertHeader(
            'Location',
            route('api.v1.articles.show', $article->getRouteKey())
        );
        $response->assertExactJson([
            'data' => [
                'type' => 'article',
                'id' => (string) $article->getRouteKey(),
                'attributes' => [
                    'title' => 'Nuevo article',
                    'slug' => 'nuevo article',
                    'content' => 'contenido del article',
                ],
                'links' => [
                    'self' => route('api.v1.articles.show', $article->getRouteKey())
                ]
            ]
        ]);
    }

    /** @test */
    public function title_is_required()
    {

        $response = $this->postJson(route('api.v1.articles.store'), [
            'data' => [
                'type' => 'article',
                'attributes' => [
                    'slug' => 'nuevo article',
                    'content' => 'contenido del article'
                ]
            ]
        ]);

        $response->assertJsonValidationErrors('data.attributes.title');
    }

    /** @test */
    public function slug_is_required()
    {

        $response = $this->postJson(route('api.v1.articles.store'), [
            'data' => [
                'type' => 'article',
                'attributes' => [
                    'title' => 'nuevo article',
                    'content' => 'contenido del article'
                ]
            ]
        ]);

        $response->assertJsonValidationErrors('data.attributes.slug');
    }

    /** @test */
    public function content_is_required()
    {

        $response = $this->postJson(route('api.v1.articles.store'), [
            'data' => [
                'type' => 'article',
                'attributes' => [
                    'title' => 'nuevo article',
                    'slug' => 'nuevo article',
                ]
            ]
        ]);

        $response->assertJsonValidationErrors('data.attributes.content');
    }
}
