@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Articles</div>
            <div class="col text-right"><a href="{{route('teacherarticles.create')}}">Create New Article</a></div>
        </div>
    </div>
    <div class="card-body">
        <div class="row p-1 my-0">
            <table class="table table-hover {{count($articles)>0? 'table-responsive' : null}}" id="myTable">
                <thead>
                    <tr>
                        <th class="text-center">Image</th>
                        <th>Article Details</th>
                        {{-- <th class="text-center">Visibility</th> --}}
                        <th class="text-center">Free</th>
                        <th class="text-center">Visibility</th>
                        <th class="text-center">Likes</th>
                        {{-- <th class="text-center">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                        <tr>
                            <td style="max-width: 130px">
                                @if(isset($article->image_path))
                                    <img src="{{url('storage/'.$article->image_path)}}" width="100%" height="90px">
                                @else
                                    No Image
                                @endif
                                <div class="btn-group btn-block">
                                    <a href="{{route('teacherarticles.show', $article->id)}}" class="btn btn-primary btn-sm" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{route('teacherarticles.edit', $article->id)}}" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    @utype('admin')
                                    <button class="btn btn-danger btn-sm" onclick="remove('{{ $article->id }}')" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    @endutype
                                </div>
                            </td>
                            <td style="width:50%">
                                <h4>{{ $article->title }}</h4>
                                <p>{{$article->description}}</p>
                            </td>
                            {{-- <td class="text-center">{{ Str::ucfirst($article->type) }}</td> --}}
                            <td class="text-center">
                                @if($article->status == 'free')
                                    <i class="fa fa-check fa-lg text-success" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-lock fa-lg text-warning" aria-hidden="true"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                <p class="p-0 m-0">{{ Str::ucfirst($article->type) }}</p>
                                <p class="p-0 m-0">{{ $article->views }} Views</p>
                            </td>
                            <td class="text-center">
                                <p class="p-0 m-0"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{ $article->likes }}</p>
                                <p class="p-0 m-0"><i class="fa fa-thumbs-down" aria-hidden="true"></i> {{ $article->dislikes }}</p>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center"><h1>No Articles Created</h1></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center pt-4">
                {{ $articles->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{url('/')}}/js/jqueryui/jquery-ui.min.js"></script>
<script>
function remove(id){
    if(confirm('Are you sure? Course Id:'+id)){
        $.post('{{route("teacherarticles.store")}}/'+id, {_token: '<?php echo csrf_token() ?>', _method: 'delete'}, (res)=>{
            // console.log(res);
            if(res.out){
                location.reload();
            }
        });
    }
}
</script>
@endsection
