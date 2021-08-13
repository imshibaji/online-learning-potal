<div>
<video
    id="{{ $id ?? 'my-video' }}"
    class="video-js vim-css vjs-fluid"
    controls
    preload="auto"
    width="{{ $witdh ?? '640' }}"
    height="{{ $height ?? '420' }}"
    poster="{{ $poster ??  url('images/poster.jpg') }}"
    @if (isset($type) && ($type=='video/youtube'))
        data-setup='{ "playbackRates": [1, 1.25, 1.5, 2], "techOrder": ["youtube"], "youtube": { "customVars": { "wmode": "transparent" ,"ytControls": 2 } } }'
    @elseif(isset($type) && ($type=='video/vimeo'))
        data-setup='{ "playbackRates": [1, 1.25, 1.5, 2], "techOrder": ["vimeo"], "vimeo": { "color": "#fbc51b"} } }'
    @else
        data-setup='{ "playbackRates": [1, 1.25, 1.5, 2] }'
    @endif
  >
    <source src="{{ $src ?? url('videos/intro.mp4') }}" type="{{$type ?? 'video/mp4'}}" />
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="{{ $url ?? 'https://larnr.com'}}" target="_blank">supports HTML5 video</a>
    </p>
</video>
</div>

@section('headers')
@parent
<link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
<style>
.video-js .vjs-big-play-button {background-color: #088cd8;top: 45%;left: 45%;font-size: 25px;line-height: 50px;height: 50px;width: 50px;border-radius: 50%;}
</style>
@endsection


@section('footers')
@parent
<script src="{{url('js/video.min.js') }}"></script>
@if (isset($type) && ($type=='video/youtube'))
<script src="{{url('js/Youtube.min.js') }}"></script>
@endif
@if (isset($type) && ($type=='video/vimeo'))
<script src="{{url('js/vimeo.min.js') }}"></script>
@endif

@isset($trackerLink)
<script>
var player = videojs('my-video', {});
var intervelId = 0;
// window.videoResponse = function(response, callback){
//     callback(response);
// };

// create listener
function playInfo() {
    intervelId = setTimeout(function() {
        var rt = player.remainingTime();
        // console.log(Math.round(rt));
        if(Math.round(rt) == 5){
            xshr('completed');
        }
        clearTimeout(intervelId);
        playInfo();
    },1000);
}
// Server data
function xshr(stat) {
    var courseId = '{{$courseId ?? 0}}';
    var topicId = '{{$topicId ?? 0}}';

    var ct = player.currentTime();
    var rt = player.remainingTime();
    var dt = player.duration();

    $.get('{{$trackerLink ?? ""}}', {
        ct : Math.round(ct || 0),
        rt : Math.round(rt || 0),
        dt: Math.round(dt || 0),
        cid: courseId,
        tid: topicId,
        status: stat
    })
    .then(res => {
        console.log(res);
    })
    .catch(err => console.log(err));
}
player.ready(function() {
    xshr('ready');
    playInfo();
});
player.on('play', function() {
    xshr('playing');
    playInfo();
});
player.on('pause', function() {
    xshr('paused');
    clearTimeout(intervelId);
});
player.on('ended', function() {
    xshr('ended');
    clearTimeout(intervelId);
});
</script>
@endisset
@endsection
