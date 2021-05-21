@extends('larnr::layouts.master')

@section('content')
<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                <h1 style="margin-top: 10px;">Search Results</h1>
                <div class="list-group" style="min-height: 66vh; margin-bottom: 1.5em">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="true">Videos</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="article-tab" data-toggle="tab" href="#article" role="tab" aria-controls="article" aria-selected="false">Articles</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="video" role="tabpanel" aria-labelledby="video-tab">
                            @forelse ($videos as $video)
                                <a href="{{ url('v/'.base64_encode($video->id)) }}" class="list-group-item list-group-item-action">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ url('storage/'.$video->image_path) }}" class="card-img-top" alt="{{$video->title}}">
                                        </div>
                                        <div class="col-8">
                                            <div class="w-100 justify-content-between">
                                                <h5 class="mb-1">{{$video->title}}</h5>
                                                <small>{{$video->keywords}}</small>
                                            </div>
                                            <p class="mb-1">{{$video->description}}</p>
                                            <small>Learning Tutorials</small>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <h3>No Search Results avaliable.</h3>
                            @endforelse
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center pt-4">
                                    {{ $videos->links('larnr::layouts.paginator') }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="article" role="tabpanel" aria-labelledby="article-tab">
                            @forelse ($articles as $article)
                                <a href="{{ url('article/'.$article->slug) }}" class="list-group-item list-group-item-action">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ url('storage/'.$article->image_path) }}" class="card-img-top" alt="{{$article->title}}">
                                        </div>
                                        <div class="col-8">
                                            <div class="w-100 justify-content-between">
                                                <h5 class="mb-1">{{$article->title}}</h5>
                                                <small>{{$article->keywords}}</small>
                                            </div>
                                            <p class="mb-1">{{$article->description}}</p>
                                            <small>Learning Tutorials</small>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <h3>No Search Results avaliable.</h3>
                            @endforelse
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center pt-4">
                                    {{ $articles->links('larnr::layouts.paginator') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
