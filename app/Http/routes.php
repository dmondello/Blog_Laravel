<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function() {
// prelevo l'elenco delle categorie per il menu...
   $categories = \App\Category::all();

   // prelevo gli articoli (includendo i dati sulle rispettive categorie ed autore associati)
   $articles = \App\Article::with('categories', 'user')->where('published_at', '<=', 'NOW()')->where('is_published', '=', true)->orderBy('published_at', 'DESC')->paginate(5);

    return view('frontend.home', ['articles' => $articles, 'categories' => $categories]);
});


Route::get('articolo/{slug}', function($slug){

    $categories = \App\Category::all();
    $article = \App\Article::with('categories', 'user')->where('slug', '=', $slug)->first();

    return view('frontend.article', compact('categories', 'article'));
});


Route::get('autore/{slug}', function($slug){

    $categories = \App\Category::all();
    $author = \App\User::where('slug', '=', $slug)->first();
    $articles = $author->articles()->where('published_at', '<=', 'NOW()')->where('is_published', '=', true)->orderBy('published_at', 'DESC')->paginate(5);

    return view('frontend.author', compact('categories', 'author', 'articles'));
});



Route::get('categoria/{slug}', function($slug){
    $categories = \App\Category::all(); $currentCategory = \App\Category::where('slug', '=', $slug)->first(); $articles = $currentCategory->articles()->where('published_at', '<=', 'NOW()')->where('is_published', '=', true)->orderBy('published_at', 'DESC')->paginate(5);

    return view('frontend.category', compact('categories', 'currentCategory', 'articles'));
});

Route::get('about/', function() {

    return view('frontend.about');
});