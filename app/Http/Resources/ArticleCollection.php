<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    public $collects = ArticleResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            // Este collection utiliza detras de escenas utiliza el ResourceArticle
            'data' => $this->collection,
            'links' => [
              'self' => route('api.v1.articles.index')
            ]
        ];
    }
}
