<div class="col">
    {{-- <form action="#" method="POST" enctype="multipart/form-data"> --}}
        <img id="img_upload" src="{{ $src ?? url('images/poster.jpg')}}" width="100%" height="150" />
        <div class="w-100 btn-group">
            <input id="file" class="btn btn-success" type="file" name="{{$name}}" accept="image/*" />
            {{-- <input class="btn btn-info" type="submit" value="Upload" /> --}}
        </div>
    {{-- </form> --}}
</div>

@section('scripts')
@parent
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#img_upload').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}
$('#file').change(function(ev){
    readURL(this);
});
</script>
@endsection
