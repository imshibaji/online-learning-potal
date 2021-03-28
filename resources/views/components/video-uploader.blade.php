<div class="col">
    {{-- <form action="#" method="POST" enctype="multipart/form-data"> --}}
    <div class="embed-responsive embed-responsive-16by9">
        <video class="embed-responsive-item" controls>
            <source src="{{ $src ?? 'mov_bbb.mp4' }}" id="video_here">
            Your browser does not support HTML5 video.
        </video>
    </div>
    <div class="w-100 btn-group">
        <input id="video" class="btn btn-success" type="file" name="{{$name}}" accept="video/*" value="{{ $src ?? ''}}" />
        {{-- <input class="btn btn-info" type="submit" value="Upload" /> --}}
    </div>
    {{-- </form> --}}
</div>

@section('scripts')
@parent
<script>
$(document).on("change", "#video", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
});
</script>

@endsection
