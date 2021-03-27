@extends('admin.learn.course.layout')

@section('contentarea')
    <table class="table table-hover" id="myTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                {{-- <th scope="col">Short</th> --}}
                <th>Course Name</th>
                {{-- <th>Description</th> --}}
                <th>Duration</th>
                <th>Status</th>
                <th>Accessible</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr id="{{ $course->short }}">
                    <td class="index text-center">
                        {{ $course->short ?? '#' }}
                        <input type="hidden" name="cid" id="cid" value="{{ $course->id }}">
                        {{-- <input size="2" type="hidden" name="short" id="index" value="{{ $course->short }}"> --}}
                    </td>
                    <td style="width:50%">{{ $course->title }}</td>
                    {{-- <td>{{ $course->meta_desc }}</td> --}}
                    <td>
                       {{ $course->duration }}
                    </td>
                    <td>{{ $course->status }}</td>
                    <td>{{ $course->accessible }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{url('/')}}/admin/learn/course/view/{{ $course->id }}" class="btn btn-primary" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{url('/')}}/admin/learn/course/edit/{{ $course->id }}" class="btn btn-warning" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @utype('admin')
                            <button class="btn btn-danger" onclick="remove('{{ $course->id }}')" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            @endutype
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-12 d-flex justify-content-center pt-4">
            {{ $courses->links() }}
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
	// var fixHelperModified = function(e, tr) {
	// 	var $originals = tr.children();
	// 	var $helper = tr.clone();
	// 	$helper.children().each(function(index) {
	// 		$(this).width($originals.eq(index).width())
	// 	});
	// 	return $helper;
	// };
    // var updateIndex = function(e, ui) {
    //     // $('td.index', ui.item.parent()).each(function (i) {
    //     //     $(this).html(i+1);
    //     // });
    //     // $('input[type=text]', ui.item.parent()).each(function (i) {
    //     //     $(this).val(i + 1);
    //     // });
    //     $('input[type=hidden]', ui.item.parent()).each(function (i) {
    //         var index = i+1;

    //         var cid = $(this).val(); // Set Key
    //         // console.log(cid,index); // Get Value

    //         $.post("{{url('/')}}/admin/learn/course/short", {_token: '<?php echo csrf_token() ?>',id: cid, short: index}, function(res){
    //             // console.log('data shorted', res);
    //             location.reload();
    //         });
    //     });
    // };

	// $("#myTable tbody").sortable({
	// 	helper: fixHelperModified,
	// 	stop: updateIndex
	// }).disableSelection();
	
    // $("tbody").sortable({
    //     distance: 5,
    //     delay: 100,
    //     opacity: 0.6,
    //     cursor: 'move',
    //     update: function() {}
    // });


    function remove(id){
        if(confirm('Are you sure? Course Id:'+id)){
            $.post('{{url('/')}}/admin/learn/course/delete/'+id, {_token: '<?php echo csrf_token() ?>'}, (res)=>{
                // console.log(res);
                if(res.out){
                    location.reload();
                }
            });
        }
    }
</script>

@endsection