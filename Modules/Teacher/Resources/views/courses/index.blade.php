@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Total {{count(Auth::user()->courses()->where('status','active')->get())}} Courses Published</div>
            <div class="col text-right">
                <a href="{{ route('teachercourses.create') }}">Create New Course</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Image</th>
                    {{-- <th scope="col">Short</th> --}}
                    <th>Course Details</th>
                    {{-- <th>Description</th> --}}
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Accessible</th>
                    {{-- <th class="text-center">Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr id="{{ $course->short }}">
                        <td class="index text-center" style="max-width: 130px">
                            {{-- {{ $course->short ?? '#' }} --}}
                            <input type="hidden" name="cid" id="cid" value="{{ $course->id }}">
                            {{-- <input size="2" type="hidden" name="short" id="index" value="{{ $course->short }}"> --}}
                            <img src="{{ isset($course->image_path) ? url('storage/'.$course->image_path) : url('images/image-upload.jpg')}}" class="img-fluid" width="100%" height="90px">
                            <div class="btn-group btn-block">
                                <a href="{{route('teachercourses.show', $course->id)}}" class="btn btn-primary btn-sm" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="{{route('teachercourses.edit', $course->id)}}" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @utype('admin')
                                <button class="btn btn-danger btn-sm" onclick="remove('{{ $course->id }}')" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                @endutype
                            </div>
                        </td>
                        <td style="width:50%">
                            <h6>{{ $course->title }}</h6>
                            <p>{{ Str::substr($course->meta_desc, 0, 160) }}...</p>
                        </td>
                        {{-- <td>{{ $course->meta_desc }}</td> --}}
                        <td class="text-center">
                           {{ $course->duration }}
                        </td>
                        <td class="text-center">
                            @if($course->status == 'active')
                                <i class="fa fa-check fa-lg text-success" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-lock fa-lg text-warning" aria-hidden="true"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            <p class="p-0 m-0">{{ Str::ucfirst($course->accessible) }}</p>
                            <p class="p-0 m-0">{{ $course->views }} Views</p>
                            <p class="p-0 m-0">{{ $course->sales }} Sales</p>
                        </td>
                        {{-- <td class="text-center">
                            <div class="btn-group">
                                <a href="{{route('teachercourses.show', $course->id)}}" class="btn btn-primary" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="{{route('teachercourses.edit', $course->id)}}" class="btn btn-warning" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @utype('admin')
                                <button class="btn btn-danger" onclick="remove('{{ $course->id }}')" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                @endutype
                            </div>
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center"><h1>No Course Created</h1></td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="row">
            <div class="col-12 d-flex justify-content-center pt-4">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('header')
<style>
td:hover{
	cursor:move;
}
</style>
@endsection

@section('scripts')
<script src="{{url('/')}}/js/jqueryui/jquery-ui.min.js"></script>
<script>
	var fixHelperModified = function(e, tr) {
		var $originals = tr.children();
		var $helper = tr.clone();
		$helper.children().each(function(index) {
			$(this).width($originals.eq(index).width())
		});
		return $helper;
	};
    var updateIndex = function(e, ui) {
        // $('td.index', ui.item.parent()).each(function (i) {
        //     $(this).html(i+1);
        // });
        // $('input[type=text]', ui.item.parent()).each(function (i) {
        //     $(this).val(i + 1);
        // });
        $('input[type=hidden]', ui.item.parent()).each(function (i) {
            var index = i+1;

            var cid = $(this).val(); // Set Key
            // console.log(cid,index); // Get Value

            $.post("{{route('teachercourses.short')}}", {_token: '<?php echo csrf_token() ?>',id: cid, short: index}, function(res){
                // console.log('data shorted', res);
                location.reload();
            });
        });
    };

	$("#myTable tbody").sortable({
		helper: fixHelperModified,
		stop: updateIndex
	}).disableSelection();

    $("tbody").sortable({
        distance: 5,
        delay: 100,
        opacity: 0.6,
        cursor: 'move',
        update: function() {}
    });


    function remove(id){
        if(confirm('Are you sure? Course Id:'+id)){
            $.post("{{route('teachercourses.destroy', "+id+") }}", {_token: '<?php echo csrf_token() ?>'}, (res)=>{
                // console.log(res);
                if(res.out){
                    location.reload();
                }
            });
        }
    }
</script>
@endsection
