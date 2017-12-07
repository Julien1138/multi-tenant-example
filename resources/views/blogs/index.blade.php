@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @foreach ($blogs as $blog)
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $blog->name }}</div>
                    <div class="panel-body">
                        <a href={{ $blog->url() }}>{{ $blog->url() }}</a>
                    </div>
                </div>
            @endforeach
            <a href={{ route('blogs.create') }} class="btn btn-primary">Créer un nouveau Blog</a>
        </div>
    </div>
</div>
@endsection