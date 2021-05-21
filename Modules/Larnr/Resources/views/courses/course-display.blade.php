<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h4 class="display-6">Learn</h4>
        <h1 class="display-4">{{$course->title}}</h1>
        <p class="lead">{{$course->meta_desc}}</p>
        <p class="lead">
            <a class="btn btn-primary" href="{{url('bill/'. '?cid='. $course->id)}}">Join Now</a>
            For Live Classroom and Full Access for Lifetime
        </p>
    </div>
</div>
