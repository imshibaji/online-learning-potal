{{-- Courses Sections --}}
@havecourses
<div class="container py-4 mb-4">
    <h2 class="text-center"><u>Top Courses</u></h2>
    <div class="row my-2">
        @foreach ($courses as $course)
        <div class="col-md-4 mt-3">
            <div class="card h-100 box">
                @if($course->ribbon)
                    <div class="ribbon-left"><span>{{$course->ribbon}}</span></div>
                @endif
                @if($course->image_path)
                    <a href="{{ url('course/'.$course->slag) }}">
                        <img height="200" src="{{ url('storage/'.$course->image_path) }}" class="card-img-top" alt="{{$course->title}}">
                    </a>
                @endif
                <div class="card-body">
                    <h5 class="text-center"><a href="{{ url('course/'. $course->slag) }}">{{ $course->title }}</a></h5>
                    <div class="pb-3">
                        @include('larnr::components.course-list-star', [
                            'star' => 4.5,
                            'reviews' => 49,
                            'language' => $course->language
                        ])
                    </div>
                    <div class="py-2">
                        <div class="text-justify">
                            {{ Str::substr($course->meta_desc, 0, 100) }}...
                        </div>
                        <div class="text-justify p-3">
                            Duration: {{ $course->duration }}<br/>
                            Price:
                            @if($course->offer_price != null)
                                <strong class="text-danger"><del>₹{{ $course->actual_price }}/-</del></strong>
                                <strong class="text-success">₹{{ $course->offer_price }}/-</strong>
                            @else
                                <strong class="text-success">₹{{ $course->actual_price }}/-</strong>
                            @endif<br/>
                            Accessible: <strong class="text-success">{{ ucwords($course->accessible) }}</strong>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="btn-group btn-block">
                            <a href="{{ url('course/'. $course->slag) }}" class="btn btn-primary">Learn More</a>
                            <a href="{{ route('checkout', ['cid' =>$course->id]) }}" class="btn btn-warning">Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endhavecourses
{{-- Courses Sections --}}
