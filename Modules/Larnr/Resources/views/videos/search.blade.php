@extends('larnr::layouts.master')

@section('content')
<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                <h1 style="margin-top: 10px;">Search Results</h1>
                <div class="list-group" style="min-height: 66vh; margin-bottom: 1.5em">
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
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
