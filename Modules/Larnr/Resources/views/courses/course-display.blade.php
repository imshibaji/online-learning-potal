<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4 class="display-6">Learn</h4>
                <h1 class="display-4">{{$course->title}}</h1>
                <p class="lead">{{$course->meta_desc}}</p>
                <p class="lead">
                    <a class="btn btn-primary" href="{{url('bill/'. '?cid='. $course->id)}}">Join Now</a>
                    For Live Classroom and Full Access for Lifetime
                </p>
            </div>
            {{-- End Course Content --}}
            <div class="col-md-6">
                @isset($course->video->video_path)
                    <div class="p-2">
                        <x-video src="{{url('storage/'.$course->video->video_path)}}" poster="{{ url('storage/'.$course->video->image_path ) }}" />
                    </div>
                @endisset
                @isset($course->embed_code)
                    <div class="p-2">
                        <x-video src="{{$course->embed_code}}" type="video/youtube" poster="{{ $course->image_path? url('storage/'.$course->image_path ) : null }}" />
                    </div>
                @endisset
                {{-- End Video --}}
            </div>
        </div>

    </div>
</div>
