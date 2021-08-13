@extends('larnr::layouts.master')

@section('title', $course->title)
@section('keywords', $course->meta_keys)
@section('description', $course->meta_desc)
@section('og_type', null)
@section('og_url', url('course/'. $course->slag))
@section('og_image', $course->image_path? url('storage/'.$course->image_path) : null)
@section('og_video', $course->video_path? url('storage/'.$course->video_path) : null)
@section('author', ($course->user)? $course->user->fname .' '. $course->user->lname : null)
@section('canonical', $course->canonical)

@section('content')
@include('larnr::courses.course-display')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="my-3 text-justify">
                <h3>Highlights</h3>
                <p>{{ $course->meta_desc }}</p>
                <p class="text-center"><a class="btn btn-link btn-sm" href="#details">Read More...</a></p>
            </div>
            {{-- Course List --}}
            <h4>Course Index</h4>
            {{-- <h5>This Course has total {{count($course->sections()->where('status', 'active')->get())}} sections and {{count($course->topics()->where('status', 'active')->get())}} topics</h5> --}}
            <ul id="course_list" class="list-group">
                <div class="accordion" id="accordionExample">
                    @foreach ($course->sections()->orderBy('short')->get() as $k => $section)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{$section->id}}">
                          <button class="accordion-button {{($k == 0)? '' : 'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$section->id}}" aria-expanded="{{($k == 0)? 'true' : 'false'}}" aria-controls="collapse{{$section->id}}">
                            {{$section->title}}
                          </button>
                        </h2>
                        <div id="collapse{{$section->id}}" class="accordion-collapse collapse {{($k == 0)? 'show' : 'hide'}}" aria-labelledby="heading{{$section->id}}" data-bs-parent="#accordionExample">
                          <div class="accordion-body p-0">
                              @foreach ($section->topics()->publish()->orderBy('short')->get() as $topic)
                                  <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#coursePreview">
                                      <span><i class="fa fa-play-circle-o"></i> {{$topic->title}}</span>
                                      @if ($topic->premium_status == 'free')
                                          <button class="btn btn-primary btn-sm text-white d-none d-md-block">
                                              <i class="fa fa-play"></i> Preview
                                          </button>
                                      @else
                                          <button  class="btn btn-sm btn-warning d-none d-md-block">
                                              <i class="fa fa-trophy"></i> Premium
                                          </button>
                                      @endif
                                  </li>
                              @endforeach
                          </div>
                        </div>
                    </div>
                    @endforeach

                    <hr id="details" class="my-3">
                    <div class="my-4 text-justify">
                        {!! $course->details !!}
                    </div>
                    <h3>Course Tags</h3>
                    <div class="mb-3">
                        @if ($course->meta_keys != "")
                            @foreach(explode(',', $course->meta_keys) as $keyword)
                                <span class="badge bg-success text-white">{{$keyword}}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </ul>
            {{-- Course List --}}
        </div>

        {{-- Sticky Description --}}
        <div class="col-md-4 mt-3 mt-md-0">
            <div class="card sidebar-fixed">
                @if($course->ribbon)
                    <div class="ribbon-left"><span>{{$course->ribbon}}</span></div>
                @endif

                @include('larnr::components.modal_btn', [
                    'image'=> $course->image_path? url('storage/'.$course->image_path) : null,
                    'title' => $course->title
                ])
                @isset($course->topics[0]->embed_code)
                    @component('larnr::components.modal')
                        @slot('title') Demo Videos @endslot
                        @slot('content')
                            <x-video id="course-preview" src="{{$course->topics[0]->embed_code}}" type="video/youtube" poster="" />
                            {{-- Topics List --}}
                            <ul class="list-group" style="max-height: 200px; overflow-y: scroll;">
                                @foreach ($course->topics()->publish()->orderBy('short')->get() as $topic)
                                    @if ($topic->premium_status == 'free')
                                    <li onclick="previewVideo('{{$topic->embed_code}}')" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span><i class="fa fa-play-circle-o"></i> {{$topic->title}}</span>

                                        <div class="btn btn-sm btn-primary text-white d-none d-md-block" onclick="previewVideo('{{$topic->embed_code}}')">
                                        <i class="fa fa-play"></i> Preview
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endslot
                    @endcomponent
                @endisset

                @if($course->session_time)
                    <div class="card-header">
                        <h6 class="pt-2">Session start: {{$course->session_time }}</h6>
                    </div>
                @endif
                <div class="card-body">
                    <div class="text-justify">
                        {{ Str::substr($course->meta_desc, 0, 100) }}...
                    </div>
                    <div class="py-3">
                        <div>Price:
                        @if($course->offer_price != null)
                            <strong class="text-danger"><del>₹{{ $course->actual_price }}/-</del></strong>
                            <strong class="text-success">₹{{ $course->offer_price }}/-</strong>
                        @else
                            <strong class="text-success">₹{{ $course->actual_price }}/-</strong>
                        @endif
                        </div>
                        <div>Duration: <strong class="text-success">{{ $course->duration }}</strong></div>
                        <div>Accessible: <strong class="text-success">{{ ucwords($course->accessible) }}</strong></div>
                        <div>Mode: <strong>Online</strong></div>
                    </div>
                    <div class=""><a href="{{ route('checkout', ['cid' =>$course->id]) }}" class="btn btn-warning btn-sm btn-block">Buy Now</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="buy-bottons d-block d-sm-none">
    <div class="row p-3">
        <div class="col-8">
            <div class="bg-white p-1 text-center">
                <strong>Price: </strong>
                @if($course->offer_price != null)
                    <strong class="text-danger"><del>₹{{ $course->actual_price }}/-</del></strong>
                    <strong class="text-success">₹{{ $course->offer_price }}/-</strong>
                @else
                    <strong class="text-success">₹{{ $course->actual_price }}/-</strong>
                @endif
            </div>
        </div>
        <div class="col">
            <a href="{{ route('checkout', ['cid' =>$course->id]) }}" class="btn btn-warning btn-sm btn-block">Buy Now</a>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.buy-bottons{
    position: fixed;
    z-index: 1;
    left: 0;
    right: 0;
    bottom: 0;
    height: 60px;
    background-color: #088cd8;
}
</style>
@endsection

@section('scripts')
@parent
<script>
$(window).on('load resize',function(){
    if(window.matchMedia("(min-width: 720px)").matches){
        $(window).scroll(function() {
            var width = $(".col-md-4").width();
            $('.sidebar-fixed').css(
            $(window).scrollTop() > 490
                ? { 'position': 'fixed', 'top': '80px', 'max-width': width }
                : { 'position': 'relative', 'top': 'auto' }
            );
        });
    }
});
</script>
<script>
var isPlay = false;
function previewVideo(video_id){
    // console.log(video_id);
    var player1 = videojs('course-display');
    player1.pause();

    var player2 = videojs('course-preview');
    player2.src({type: 'video/youtube', src: video_id});
    player2.load();
    player2.play();

    var cur = player2.currentTime();
    var dur = player2.duration();
    // console.log(cur, dur);
}
$(window).on('load',function(){
    $('#modal_clode_btn, #modal_clode_btn1').click(function(){
        var player2 = videojs('course-preview');
        player2.pause();
        // console.log('modal click');
    });
});

function youtube_parser(url){
    var regExp = /^https?\:\/\/(?:www\.youtube(?:\-nocookie)?\.com\/|m\.youtube\.com\/|youtube\.com\/)?(?:ytscreeningroom\?vi?=|youtu\.be\/|vi?\/|user\/.+\/u\/\w{1,2}\/|embed\/|watch\?(?:.*\&)?vi?=|\&vi?=|\?(?:.*\&)?vi?=)([^#\&\?\n\/<>"']*)/i;
    var match = url.match(regExp);
    return (match && match[1].length==11)? match[1] : false;
}
</script>
@endsection
