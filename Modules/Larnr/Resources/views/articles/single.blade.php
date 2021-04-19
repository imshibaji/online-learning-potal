@extends('larnr::layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9 p-0 py-sm-2">
            <div class="card m-2">
                @if(isset($article->video_path))
                    <div class="embed-responsive embed-responsive-16by9">
                        {!! $article->video_path !!}
                    </div>
                @endif
                <div class="card-header my-auto">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="my-auto">{{$article->title}}</h5>
                            <small class="my-1 card-text text-muted">
                                <span class="d-none d-sm-inline">Category: </span>{{ $category ?? 'Skill Learning Tutorials' }}
                            </small>

                        </div>
                        <div class="col-4 text-right">
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
        <div class="col-md-3 col-12 p-0 pr-md-2 py-sm-2">
            <div class="row px-2">
                @foreach ($articles as $article)
                <div class="col-6 col-md-12 my-2">
                    <div class="card box my-0 pb-0 h-100 h-sm-none">
                        <a style="text-decoration: none" href="{{ url('article/'.$article->slug) }}">
                            <img src="{{ url('storage/'.$article->image_path) }}" class="card-img-top" alt="{{$article->title}}">
                            <div class="card-body p-1 p-sm-3">
                                <h6 class="card-title my-1">{{ Str::substr($article->title, 0, 35) }}</h6>
                                <small class="d-none d-md-inline card-text text-dark">{{ Str::substr($article->description, 0, 40)}}...</small><br class="d-none d-md-inline">
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
