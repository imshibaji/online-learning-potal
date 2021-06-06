@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Articles</div>
            <div class="col text-right"><a href="{{ route('teacherarticles.edit', $article->id) }}">Edit Course</a></div>
        </div>
    </div>
    <div class="card-body">
        <h1>{{$article->title}}</h1>
        <img class="img-fluid mb-3" src="{{ url('storage/'.$article->image_path) }}" />
        {!! $article->details !!}
    </div>
</div>
@endsection
