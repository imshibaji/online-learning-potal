<div class="row">
@foreach ($videos as $video)
<div class="col-md-3 p-2">
    <div class="card">
        <a href="{{ url('user/video/'.$video->slug) }}">
            <img src="{{ url('storage/'.$video->image_path) }}" class="card-img-top" alt="{{$video->title}}">
        </a>
        <div class="card-body">
            <a href="{{ url('user/video/'.$video->slug) }}">
                <h6 class="card-title my-1">{{ Str::substr($video->title, 0, 25) }}...</h6>
            </a>
            <p class="card-text">{{ Str::substr($video->description, 0, 50)}}...</p>
        </div>
    </div>
</div>
@endforeach
</div>
