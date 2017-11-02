@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            {{ Form::open(['method' => 'put', 'url' => route('articles.update', $article)]) }}
                
                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', $article->title, ['class' => 'form-control']) }}
                </div>
                
                <div class="form-group">
                    {{ Form::label('content', 'Content') }}
                    {{ Form::textarea('content', $article->content, ['class' => 'form-control', 'rows' => "10"]) }}
                </div>
                
                <button class="btn btn-primary">Enregistrer les changements</button>
            {{ Form::close() }}
        </div>
        <div class="col-md-4">
            {{ Form::open(['method' => 'delete', 'url' => route('articles.destroy', $article->id)]) }}
                <button class="btn btn-primary btn-danger">Supprimer l'article</button>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
