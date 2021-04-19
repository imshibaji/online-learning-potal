<div class="col">
    {{-- <form action="#" method="POST" enctype="multipart/form-data"> --}}
    <div class="embed-responsive embed-responsive-16by9">
        <video class="embed-responsive-item" controls>
            <source src="{{ $src ?? '' }}" id="video_here">
            Your browser does not support HTML5 video.
        </video>
    </div>
    <div class="w-100 btn-group">
        <select id="video" class="form-control" name="vid">
            <option value="0">None</option>
            @foreach ($videos as $video)
                @if($video->id == $vid)
                    <option value="{{$video->id}}" selected>{{$video->title}} Used: {{$video->videoable}}</option>
                @else
                    <option value="{{$video->id}}">{{$video->title}}  {{$video->videoable}}</option>
                @endif
            @endforeach
        </select>
        {{-- <input class="btn btn-info" type="submit" value="Upload" /> --}}
    </div>
    {{-- </form> --}}
</div>

@section('scripts')
@parent
<script>
var videos = @json($videos);

$(document).ready(function(){
    var video_id = @json($vid);
    // console.log(video_id);
    videoLoad(video_id);
});
$(document).on("change", "#video", function(evt) {
  console.log(evt.target.value);
  videoLoad(evt.target.value);
});
function videoLoad(vid){
    var video = videos.filter((v) => {
        return v.id == vid;
    })[0];
    // console.log(video);
    if(video){
        var $source = $('#video_here');
        $source[0].src = '/storage/'+ video.video_path;
        $source.parent()[0].load();

        var editor = CKEDITOR.instances['editor'];
        var cont = editor.getData();
        // console.log(cont, !cont);
        if(!cont){
            editor.setData(video.details);
        }
    }
}
</script>

@endsection
