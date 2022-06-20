{{-- Course / Topics Details --}}
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item d-block d-md-none">
        <a class="nav-link" id="menus-tab" data-toggle="tab" href="#menus" role="tab" aria-controls="menus" aria-selected="true">Course Index</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" id="topic-tab" data-toggle="tab" href="#topic" role="tab" aria-controls="topic" aria-selected="true">Details</a>
    </li>
    {{--
    @if(count($assesments ?? []) == 0)
      <li class="nav-item d-none d-md-block">
        <a class="nav-link" id="exam-tab" data-toggle="tab" href="#exam" role="tab" aria-controls="exam" aria-selected="false">Assignments</a>
      </li>
    @else
      <li class="nav-item d-none d-md-block">
        <a class="nav-link" id="assesment-tab" data-toggle="tab" href="#assesment" role="tab" aria-controls="assesment" aria-selected="false">Assesments Report</a>
      </li>
    @endif
    --}}
    <li class="nav-item">
      <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false">Comments</a>
    </li>
  </ul>

  {{-- Course Contents --}}
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show" id="menus" role="tabpanel" aria-labelledby="menus-tab">
        <div class="scrollbar" style="height: 45vh">
            {{-- Menu Index --}}
            <div class="list-group pb-2">
                {{-- <a href="{{ url('/') }}/user/course-details/{{$course->id}}" class="list-group-item list-group-item-action {{ Request::is('user/course-details/'.$course->id) ? 'active' : '' }}">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Course Overview
                </a> --}}
                @foreach ($topics as $ta)
                    @if($ta->status == 'active')
                        <a id="Label{{$ta->id}}" href="{{ url('/') }}/user/course-details/{{$course->id}}/{{$ta->id}}#Label{{$ta->id}}" class="list-group-item list-group-item-action {{ Request::is('user/course-details/'.$course->id.'/'.$ta->id) ? 'active' : '' }}">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            {{ $ta->title }}
                        </a>
                    @endIf
                @endforeach
            </div>
            {{-- End Menu Index --}}
        </div>
    </div>

    <div class="tab-pane fade show active" id="topic" role="tabpanel" aria-labelledby="topic-tab">
        {{-- Topics Details --}}
        <div class="p-3">
            @if ($topic)
                <div>{!! $topic->details !!}</div>
            @else
                <h1>Please choose Topic from Left Side</h1>
            @endif
        </div>
    </div>

    @if(count($assesments ?? []) == 0)
    <div class="tab-pane fade" id="exam" role="tabpanel" aria-labelledby="exam-tab">
        <div class="p-3">
            @if (count($topic->questions ?? []) > 0)
            <form action="{{route('userassesment')}}" method="POST">
              @csrf
              <input type="hidden" name="user_id" value="{{Auth::id()}}">
              <input type="hidden" name="topic_id" value="{{$topic->id}}">

                @foreach ($topic->questions as $k => $q)
                  {{-- <input type="hidden" name="qid[]" value="{{$q->id}}"> --}}
                  <div class="shadow p-3 mb-2 bg-white rounded">
                    <h6>Question {{$k+1}}:</h6>
                    <div>{!! $q->question !!}</div>
                    @php $opts = json_decode($q->opt, true) @endphp

                    @if($q->qtype == 1)
                      @foreach ($opts as $key => $val)
                          <div>
                              <label>{{$key + 1}}. <input type="radio" name="ans{{$q->id}}[]" value="{{$key + 1}}">
                              {{ $val }}</label>
                          </div>
                      @endforeach
                    @elseIf($q->qtype == 2)
                      @foreach ($opts as $key => $val)
                          <div>
                              <label>{{$key + 1}}. <input type="checkbox" name="ans{{$q->id}}[]" value="{{$key + 1}}">
                              {{ $val }}</label>
                          </div>
                      @endforeach
                    @elseIf($q->qtype == 3)
                          <div class="py-2">
                              <textarea class="form-control" name="ans{{$q->id}}" required></textarea>
                          </div>
                    @endIf
                  {{-- Opt Details --}}
                </div>
                @endforeach
              {{-- End Questions Loop --}}

              <div class="shadow-none p-3 mt-4 bg-light rounded text-center">
                <input type="submit" class="btn btn-success" value="Submit Your Answers">
              </div>
            </form>
            @else
              <h1 class="text-center">No Questions Prepared.</h1>
            @endif
        </div>
    </div>


    {{-- Assesment Section Start --}}
    @else
    <div class="tab-pane fade" id="assesment" role="tabpanel" aria-labelledby="assesments-tab">

        @foreach ($assesments as $assesment)
          @php
              $asses = json_decode($assesment->assesment, true);
              // dump($assesment);
              // dump($asses);
          @endphp

          <div class="p-3">
            <h1 class="text-center">Report Card</h1>
            <div class="row">
              <div class="col">
                <div class="c-callout c-callout-info">
                  <small class="text-muted">Design</small><br>
                  <strong class="h4">{{$asses['design']}}</strong>
                </div>
              </div><!--/.col-->
              <div class="col">
                <div class="c-callout c-callout-warning">
                  <small class="text-muted">Development</small><br>
                  <strong class="h4">{{$asses['development']}}</strong>
                </div>
              </div>
              <div class="col">
                <div class="c-callout c-callout-success">
                  <small class="text-muted">Debugging</small><br>
                  <strong class="h4">{{$asses['debug']}}</strong>
                </div>
              </div>
              <div class="col">
                <div class="c-callout c-callout-primary">
                  <small class="text-muted">Total Points</small><br>
                  <strong class="h4">{{$asses['total']}}</strong>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="p-3">
            @foreach ($asses['report'] as $r)
              <div class="shadow p-3 mb-2 bg-white rounded">
                <h5>Question: </h5>
                {!!$r['title'] !!}

                @if(isset($r['user_answer']))
                  <div class="pb-4">
                      <span class="text-primary">Your Answer:</span>
                      {!! $r['user_answer'] !!}
                  </div>
                @endif

                @if($r['remark'] == 'Correct')
                  <h5 class="text-success">You Answer is Correct</h5>
                @elseIf($r['remark'] == 'InCorrect')
                  <h5 class="text-danger">You Answer is Inorrect</h5>
                @else
                  <h5 class="text-primary">You Answer is Thoughful</h5>
                @endif


                <div class="shadow-none p-3 bg-light rounded text-left">
                  <strong>Correct Answer:</strong>
                  {!! $r['answer'] !!}
                </div>
              </div>
            @endforeach
          </div>
        @endforeach
        <div class="shadow-none p-3 bg-light rounded text-center">
          <a class="btn btn-primary" href="{{route('userretry', $assesment->topic_id)}}">
            Retry Again
          </a>
        </div>
    </div>
    @endif

    {{-- Comments --}}
    <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
         {{-- <x-discussions :topic="$topic" :comments="$comments" /> --}}
         @component('user::components.discussions', ['topic'=> $topic, 'comments'=> $comments ])
         @endcomponent
    </div>
</div>
