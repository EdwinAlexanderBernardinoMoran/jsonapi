<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('articles', [ArticleController::class, 'index'])->name('api.v1.articles.index');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('api.v1.articles.show');
