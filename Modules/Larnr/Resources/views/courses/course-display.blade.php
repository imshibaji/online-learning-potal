<div class="jumbotron jumbotron-fluid" style="background: url(/images/course-display.jpeg);background-repeat: no-repeat;background-size: cover;background-position: 30% 30%;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-3" style="background:rgba(15, 15, 15, 0.7);">
                <div class="ribbon-right"><span>POPULAR</span></div>
                <h4 class="display-6 text-white">Learn</h4>
                <h1 class="display-5 text-white">{{$course->title}}</h1>
                <div class="pb-3">@include('larnr::components.course-star', ['star' => 4.5, 'reviews' => rand(40,50)])</div>
                <p class="lead text-white">{{$course->meta_desc}}</p>
                <p class="lead text-white">
                    <a class="btn btn-primary" href="{{url('bill/'. '?cid='. $course->id)}}">Join Now</a>
                    For Live Classroom and Full Access for Lifetime
                </p>
            </div>
            {{-- End Course Content --}}
            <div class="col-md-6 py-4">
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
