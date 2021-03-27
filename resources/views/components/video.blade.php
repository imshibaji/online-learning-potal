<div>
<video
    id="my-video"
    class="video-js vim-css vjs-fluid"
    controls
    preload="auto"
    width="{{ $witdh ?? '640' }}"
    height="{{ $height ?? '420' }}"
    poster="{{ $poster ??  url('images/poster.jpg') }}"
    data-setup='{ "playbackRates": [1, 1.25, 1.5, 2] }'
  >
    <source src="{{ $src ?? url('videos/intro.mp4') }}" type="{{$type ?? 'video/mp4'}}" />
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
      >
    </p>
</video>
</div>

@section('headers')
@parent
<link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
<style>
.video-js .vjs-big-play-button {top: 45%;left: 45%;font-size: 15px;line-height: 30px;height: 30px;width: 30px;border-radius: 50%;}
</style>

@endsection
@section('scripts')
@parent
<script src="https://vjs.zencdn.net/7.11.4/video.min.js"></script>
<script>
var player = videojs('my-video', {
//   autoplay: 'muted',
});
</script>
@endsection