<div class="col">
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="w-100 btn-group">
            <input id="file" class="btn btn-success" type="file" name="file" />
            <input class="btn btn-info" type="submit" value="Upload" />
        </div>
    </form>
</div>

<div id="app">
    <file-uploader
            :unlimited="true"
            collection="avatars"
            name="media"
            :tokens="{{ json_encode(old('media', [])) }}"
            label="Upload Avatar"
            notes="Supported types: jpeg, png,jpg,gif"
            {{-- accept="image/jpeg,image/png,image/jpg,image/gif" --}}
    ></file-uploader>
</div>

@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-file-uploader"></script>
<script>
  new Vue({
    el: '#app'
  })
</script>
@endsection
