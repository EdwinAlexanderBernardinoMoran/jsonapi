<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ArticleCollection
    {
        $articles = Article::all();
        return ArticleCollection::make($articles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'data.attributes.title' =>  ['required'],
            'data.attributes.slug' =>  ['required'],
            'data.attributes.content' =>  ['required'],
        ]);
        // dd($request->input('data.attributes')); Muestra todos los campo
        $article = Article::create([
            'title' => $request->input('data.attributes.title'),
            'slug' => $request->input('data.attributes.slug'),
            'content' => $request->input('data.attributes.content'),
        ]);

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): ArticleResource
    {

        // Es necesario crear un resource para mejor codigo, puedes utilizar cualquier opcion
        // return ArticleResource::make($article);
        return new ArticleResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
