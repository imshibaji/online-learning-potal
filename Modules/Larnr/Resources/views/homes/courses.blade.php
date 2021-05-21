{{-- Courses Sections --}}
<div class="container">
    <div class="row my-5">
        @foreach ($courses as $course)
        <div class="col-md-3 my-3">
            <div class="card h-100 box">
            <h4 class="text-center mt-3"><a href="{{ url('course/'. $course->slag) }}">{{ $course->title }}</a></h4>
            <div class="py-2">
                <div class="text-justify px-2">
                    {{$course->meta_desc}}.
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
            </div>
        </div>
        @endforeach
    </div>
</div>
{{-- Courses Sections --}}
