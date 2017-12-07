@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            {{ Form::open(['url' => route('blogs.store')]) }}
                
                <div class="form-group">
                    {{ Form::label('name', 'Nom du blog') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
                
                <button class="btn btn-primary">Créer le nouveau blog</button>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
