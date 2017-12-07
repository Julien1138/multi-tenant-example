@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @foreach ($articles as $article)
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $article->title }}</div>
                    <div class="panel-body">
                        {{ $article->content }}
                        <br/>
                        <br/>
                        <a href={{ route('articles.edit', $article->id) }} class="btn btn-primary">Modifier</a>
                    </div>
                </div>
            @endforeach
            <a href={{ route('articles.create') }} class="btn btn-primary">Ajouter un article</a>
        </div>
    </div>
</div>
@endsection