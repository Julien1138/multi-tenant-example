@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            {{ Form::open(['url' => route('articles.store')]) }}
                
                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', null, ['class' => 'form-control']) }}
                </div>
                
                <div class="form-group">
                    {{ Form::label('content', 'Content') }}
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => "10"]) }}
                </div>
                
                <button class="btn btn-primary">Créer le nouvel article</button>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
