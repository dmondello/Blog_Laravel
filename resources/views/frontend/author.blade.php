@extends('frontend.master.layout')

@section    ('title') Articoli di {{ $author->first_name . ' ' . $author->last_name }}  @endsection

@section('subheading') Articoli di {{ $author->first_name . ' ' . $author->last_name }} @endsection

@section('content')
    @foreach($articles as $article)
        <div class="post-preview">
            <a href="{{ url('articolo/' . $article->slug) }}">
                <h2 class="post-title">
                    {{ $article->title }}
                </h2>
            </a>
            <p class="post-meta">Scritto da <a href="{{ url('autore/' . $article->user->slug) }}">{{ $article->user->first_name . ' ' . $article->user->last_name }}</a>, il {{ date('d/m/Y H:i', strtotime($article->published_at)) }}</p> <p> <b>Categorie: </b>

                @foreach($article->categories as $category)
                    <a href="{{ url('categoria/' . $category->slug) }}">{{ $category->name }}</a> /
                @endforeach
            </p>
            {!! $article->body !!}
            <hr/>
        </div>
    @endforeach <div style="text-align: center;">
        {!! $articles->render() !!} </div>
@endsection