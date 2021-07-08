@extends('larnr::layouts.master')

@section('title', $article->title)
@section('keywords', $article->keywords)
@section('description', $article->description)
@section('og_type', 'article')
@section('og_url', url('article/'. $article->slug))
@section('og_image', $article->image_path? url('storage/'.$article->image_path) : null)
@section('og_video', $article->video_path? url('storage/'.$article->video_path) : null)
@section('author', ($article->user)? $article->user->fname .' '. $article->user->lname : null)
@section('canonical', $article->canonical)

@section('content')
<div class="container">
    <div class="row mx-0 mx-md-none">
        <div class="col-md-9 p-0 py-sm-2">
            <div class="card mx-0 mt-2 m-md-2 mx-md-none">
                @if(isset($article->video_path))
                    <x-video poster="{{ url('storage/'.$article->image_path) }}" src="{{$article->video_path}}" type="video/youtube" />

                @else
                    <div class="mt-0" style="height: 350px; overflow: hidden; margin-top: -100px">
                        <img width="100%" src="{{ url('storage/'.$article->image_path) }}" alt="{{$article->title}}" />
                    </div>
                @endif
                <div class="card-header my-auto">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="my-auto">{{$article->title}}</h5>
                            <small class="my-1 card-text text-muted">
                                <span class="d-none d-sm-inline">Category: </span>{{ $category ?? 'Skill Learning Tutorials' }}
                            </small>

                        </div>
                        <div class="col-md-4 text-md-right">
                            <div><small class="my-1 card-text text-muted">{{$author ?? 'Larnr Education'}} <span class="d-none d-sm-inline"> | </span> {{$article->views}}views </small></div>
                            <div class="d-none d-sm-block"><a class="btn btn-warning btn-sm" href="https://app.larnr.com?w=EnrollNow">Enroll Now</a></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- <h6>Details</h6> --}}
                    {!! $article->details !!}
                </div>
                <div class="card-footer">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{url('article/comment')}}" method="POST">
                        @csrf
                        <input type="hidden" name="aid" value="{{base64_encode($article->id)}}" />
                        <textarea class="form-control" name="message" placeholder="Enter Your Comment"></textarea>
                        <button type="submit" class="btn btn-primary">Comment Now</button>
                    </form>
                </div>
                <x-comments :messages="$article->comments" />
            </div>
        </div>
        <div class="col-md-3 p-0 py-sm-2">
            <div class="row">
                @foreach ($articles as $article)
                <div class="col-6 col-md-12 my-2">
                    <div class="card box my-0 pb-0 h-100 h-sm-none">
                        <a style="text-decoration: none" href="{{ url('article/'.$article->slug) }}">
                            <img src="{{ url('storage/'.$article->image_path) }}" class="card-img-top" alt="{{$article->title}}">
                            <div class="card-body p-1 p-sm-3">
                                <h6 class="card-title my-1">{{ Str::substr($article->title, 0, 35) }}</h6>
                                <small class="d-none d-md-inline card-text text-dark">{{ Str::substr($article->description, 0, 60)}}...</small><br class="d-none d-md-inline">
                                <small class="my-1 card-text text-muted">{{($article->user)? $article->user->fname .' '. $article->user->lname : 'Larnr Education'}} <span class="d-none d-sm-inline"> | </span> {{$article->views}}views</small>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
