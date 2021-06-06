@extends('admin.articles.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/article') }}" class="btn btn-primary">Article List</a>
    </div>
@endsection

@section('videocontent')
<div class="row p-1 my-0">
    <table class="table table-hover" id="myTable">
        <thead>
            <tr>
                <th>Image</th>
                <th>Article Details</th>
                <th>Type</th>
                <th>Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>@if(isset($article->image_path))<img src="{{url('storage/'.$article->image_path)}}" class="img-fluid" width="200px">@else No Image @endif</td>
                    <td style="width:50%">
                        <h4>{{ $article->title }}</h4>
                        <p>{{$article->description}}</p>
                    </td>
                    <td>{{ $article->type }}</td>
                    <td>{{ $article->status }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{url('/')}}/admin/article/restore/{{ $article->id }}" class="btn btn-warning" title="Restore"><i class="fa fa-recycle" aria-hidden="true"></i></a>
                            @utype('admin')
                            <button class="btn btn-danger" onclick="remove('{{ $article->id }}')" title="Forced Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            @endutype
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-12 d-flex justify-content-center pt-4">
        {{ $articles->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
@section('scripts')
<script src="{{url('/')}}/js/jqueryui/jquery-ui.min.js"></script>
<script>
function remove(id){
    if(confirm('Are you sure? Article Id:'+id)){
        $.post('{{url('/')}}/admin/article/clear/'+id, {_token: '<?php echo csrf_token() ?>'}, (res)=>{
            // console.log(res);
            if(res.out){
                location.reload();
            }
        });
    }
}
</script>
@endsection
