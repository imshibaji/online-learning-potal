<div class="col-md-8">
    <div id="course_content">
        @if ($topic)
                <h1 class="text-center">{{$topic->title}}</h1>
                <div class="py-3">{!! $topic->embed_code !!}</div>
                @include('users.learn.contents')
        @else
            <h1><- Please choose Topic from Left Side</h1>
        @endif
    </div>


</div>
