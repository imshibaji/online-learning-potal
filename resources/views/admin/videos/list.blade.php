@extends('admin.videos.layout')

@section('videocontent')
<div class="row p-1 my-0">
    @foreach ($videos as $video)
    <div class="col-md-3 p-1 my-0">
        <div class="card">
            <img src="{{ url('storage/'.$video->image_path) }}" class="card-img-top" alt="{{$video->title}}">
            <div class="card-body">
              <h6 class="card-title">{{ Str::substr($video->title, 0, 28) }}</h6>
              <p class="card-text">{{ Str::substr($video->description, 0, 50)}}...</p>
              <div class="text-center">
                <div class="btn-group">
                    <a href="{{ url('admin/video/'. $video->id)}}" class="btn btn-primary">View</a>
                    <a href="{{ url('admin/video/'. $video->id . '/edit')}}" class="btn btn-warning">Edit</a>
                    @utype('admin')
                    <button class="btn btn-danger" onclick="remove('{{ $video->id }}')" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    @endutype
                  </div>
              </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-12 d-flex justify-content-center pt-4">
        {{ $videos->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection

@section('scripts')
<script src="{{url('/')}}/js/jqueryui/jquery-ui.min.js"></script>
<script>
function remove(id){
    if(confirm('Are you sure? Video Id:'+id)){
        $.post('{{url('/')}}/admin/video/'+id, {_token: '<?php echo csrf_token() ?>', _method: 'delete'}, (res)=>{
            console.log(res);
            if(res.out){
                location.reload();
            }
        });
    }
}
</script>
@endsection
