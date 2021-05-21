@extends('larnr::layouts.master')

@section('content')
@include('larnr::articles.display')
<div class="container">
    <div class="row justify-content-start">
        @foreach ($articles as $article)
        <div class="col-md-3 my-3">
            <div class="card h-100 box">
                <a href="{{ url('article/'.$article->slug) }}">
                    <img height="140" src="{{ url('storage/'.$article->image_path) }}" class="card-img-top" alt="{{$article->title}}">
                </a>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 m-0">
                            <a class="my-0" href="{{ url('article/'.$article->slug) }}">
                                <h6 class="card-title my-1">{{ Str::substr($article->title, 0, 35) }}</h6>
                            </a>
                            <small class="my-1 card-text">{{ Str::substr($article->description, 0, 40)}}...</small><br>
                            <small class="my-1 card-text text-muted">{{($article->user)? $article->user->fname .' '. $article->user->lname : 'Larnr Education'}} | {{$article->views}}views </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
