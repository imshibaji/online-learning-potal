<div class="col-md-9">
    <div id="course_content">
        @if ($topic)
                <h1 class="text-center">{{$topic->title}}</h1>
                {{-- <div class="py-3">{!! $topic->embed_code !!}</div> --}}
                <div class="py-3">
                    @isset ($topic->video)
                        <x-video src="{{url('storage/'.$topic->video->video_path)}}" poster="{{ url('storage/'.$topic->video->image_path ) }}" />
                    @endisset
                    @isset($topic->embed_code)
                        <x-video src="{{$topic->embed_code}}" type="video/youtube" poster="{{ url('storage/'.$topic->image_path ) }}" />
                    @endisset
                </div>
                @include('users.learn.contents')
        @else
            <h1><- Please choose Topic from Left Side</h1>
        @endif
    </div>


</div>
