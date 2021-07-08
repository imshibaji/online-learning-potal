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
        {{-- <img class="img-fluid mb-3" src="{{ url('storage/'.$article->image_path) }}" /> --}}
        <div class="row">
            <div class="col-md order-2 order-md-1">
                <div class="row">
                    <div class="col p-3 text-center"><i class="fa fa-eye" aria-hidden="true"></i> {{$article->views}}</div>
                    <div class="col p-3 text-center"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$article->likes}}</div>
                    <div class="col p-3 text-center"><i class="fa fa-thumbs-down" aria-hidden="true"></i> {{$article->dislikes}}</div>
                    <div class="col p-3 text-center"><i class="fa fa-share-alt" aria-hidden="true"></i> {{$article->shares}}</div>
                </div>
                <div class="row">
                    <div class="col p-3 text-center"><strong>Created At</strong> <p>{{$article->created_at}}</p></div>
                    <div class="col p-3 text-center"><strong>Modified At</strong> <p>{{$article->updated_at}}</p></div>
                    <div class="col p-3 text-center"><strong>Realease Status</strong> <p>{{$article->type}}</p></div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="text-justify">{{ Str::substr($article->description, 0, 300) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md order-1 order-md-2">
                @if(isset($article->video_path))
                    <x-video poster="{{ url('storage/'.$article->image_path) }}" src="{{$article->video_path}}" type="video/youtube" />
                @else
                    <div class="mt-0">
                        <img class="img-fluid mb-3" src="{{ url('storage/'.$article->image_path) }}" alt="{{$article->title}}" />
                    </div>
                @endif
            </div>
        </div>

        <h1 class="mt-3">{{$article->title}}</h1>
        <div class="mb-4">
            @if ($article->keywords != "")
                @foreach(explode(',', $article->keywords) as $keyword)
                    <span class="badge bg-secondary text-white">{{$keyword}}</span>
                @endforeach
            @endif
        </div>
        {!! $article->details !!}
    </div>
</div>
@endsection
