{{-- Videos Sections --}}
<div class="container">
    <div class="row my-5">
        @foreach ($videos as $video)
        <div class="col-md-3 my-3">
            <div class="card h-100 box">
                <a href="{{ url('v/'.base64_encode($video->id)) }}">
                    <img src="{{ url('storage/'.$video->image_path) }}" class="card-img-top" alt="{{$video->title}}">
                </a>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 m-0">
                            <a class="my-0" href="{{ url('v/'.base64_encode($video->id)) }}">
                                <h6 class="card-title my-1">{{ Str::substr($video->title, 0, 35) }}</h6>
                            </a>
                            <small class="my-1 card-text">{{ Str::substr($video->description, 0, 40)}}...</small><br>
                            <small class="my-1 card-text text-muted">{{($video->user)? $video->user->fname .' '. $video->user->lname : 'Larnr Education'}} | {{$video->views}}views </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
{{-- Videos Sections --}}
