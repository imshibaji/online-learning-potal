<div class="col-md-3">
    {{-- Learning Section --}}
    <div class="accordion" id="accordionExample">
        @foreach ($courses as $key => $learn )
        <div class="card">
            <div class="card-header" id="heading{{ $learn->course->id }}">
            <h2 class="mb-0">
                <button class="btn btn-default btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{ $learn->course->id }}" aria-expanded="true" aria-controls="collapse{{ $learn->course->id }}">
                    Course {{$key + 1}}: {{ $learn->course->title }}
                </button>
            </h2>
            </div>
            <div id="collapse{{ $learn->course->id }}" class="collapse" aria-labelledby="heading{{ $learn->course->id }}" data-parent="#accordionExample">
            <div class="card-body">
                <div class="list-group">
                    {{-- <a href="#" class="list-group-item list-group-item-action active">
                        Overview
                    </a> --}}
                    @foreach ($topics as $ta)
                        @if($ta->topic->course_id == $learn->course->id)
                            <a href="{{ url('/')}}/user/learn?tid={{$ta->topic->id}}" class="list-group-item list-group-item-action">{{ $ta->topic->title }}</a>
                        @endIf
                    @endforeach
                </div>
            </div>
            </div>
        </div>
        @endforeach
    </div>
    {{-- Learning Section --}}

    <div class="card my-3" id="comment_section">
        <div class="card-body">
            <h5 class="text-center">Feedback Section</h5>
            <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" class="form-control" id="Title" placeholder="Short Title">
            </div>
            <div class="form-group">
                <label for="Message">Message</label>
                <textarea class="form-control" id="Message" placeholder="Comment in Detail"></textarea>
            </div>
            <input type="submit" class="btn btn-outline-success btn-block" value="Submit" />
        </div>
    </div>
    {{-- End FeedBack --}}

</div>
