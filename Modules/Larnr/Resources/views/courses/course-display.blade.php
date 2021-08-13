<div class="jumbotron jumbotron-fluid" style="background: url(/images/course-display.jpeg);background-repeat: no-repeat;background-size: cover;background-position: 30% 30%;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-3 order-2 order-md-1" style="background:rgba(15, 15, 15, 0.7);">
                <div class="px-3 pt-4">
                    @if($course->ribbon)
                        <div class="ribbon-right"><span>{{$course->ribbon}}</span></div>
                    @endif
                    @if($course->mode)
                        <h5 class="text-warning">{{ $course->mode }}</h5>
                    @else
                        <h5 class="text-white">Learn</h5>
                    @endif
                    <h2 class="text-white mb-0">{{$course->title}}</h2>
                    <p class="mb-3"><small class="text-white">Last Update: {{ $course->updated_at->format('jS F Y') }}</small></p>
                    <p class="lead text-white">{{ Str::substr($course->meta_desc, 0, 100) }}...</p>
                    <div class="pb-1">
                        @include('larnr::components.course-star', [
                            'star' => 4.5,
                            'reviews' => 49,
                            'language' => $course->language
                        ])
                    </div>
                    <div class="pb-4 text-left">
                        <strong class="text-white">Price: </strong>
                        @if($course->offer_price != null)
                            <strong class="text-danger"><del>₹{{ $course->actual_price }}/-</del></strong>
                            <strong class="text-success">₹{{ $course->offer_price }}/-</strong>
                        @else
                            <strong class="text-success">₹{{ $course->actual_price }}/-</strong>
                        @endif
                    </div>
                    <p class="lead text-white">
                        <a class="btn btn-primary" href="{{ route('checkout', ['cid' =>$course->id]) }}">Join Now</a>
                        For Live Classroom and Full Access for Lifetime
                    </p>
                </div>
            </div>
            {{-- End Course Content --}}
            <div class="col-md-6 py-0 order-1 order-md-none">
                <div class="py-md-1" style="background:rgba(15, 15, 15, 0.7);">
                    @isset($course->video->video_path)
                        <div class="p-2">
                            <x-video id="course-display" src="{{url('storage/'.$course->video->video_path)}}" poster="{{ url('storage/'.$course->video->image_path ) }}" />
                        </div>
                    @endisset
                    @isset($course->embed_code)
                        <div class="p-2">
                            <x-video id="course-display" src="{{$course->embed_code}}" type="video/youtube" poster="{{ $course->image_path? url('storage/'.$course->image_path ) : null }}" />
                        </div>
                    @endisset
                    {{-- End Video --}}

                    <h4 class="text-white display-6 pb-4 pt-2 text-center">Quick information video</h4>
                </div>
            </div>
        </div>

    </div>
</div>
