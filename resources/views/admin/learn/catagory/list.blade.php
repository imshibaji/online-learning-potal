@extends('admin.learn.catagory.layout')

@section('contentarea')
    <table class="table table-hover" id="myTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                {{-- <th scope="col">Short</th> --}}
                <th>Catagory Name</th>
                {{-- <th>Details</th> --}}
                <th>Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($catagories as $catagory)
                @php
                    $dur = json_decode($catagory->duration, true);
                    // var_dump($dur['hours']);
                @endphp
                <tr id="{{ $catagory->short }}">
                    <td class="index text-center">
                        {{ $catagory->short ?? '#' }}
                        <input type="hidden" name="cid" id="cid" value="{{ $catagory->id }}">
                        {{-- <input size="2" type="hidden" name="short" id="index" value="{{ $course->short }}"> --}}
                    </td>
                    {{-- <td class="indexInput">
                        <input type="hidden" name="cid" id="cid" value="{{ $course->id }}">
                        <input size="2" type="hidden" name="short" id="index" value="{{ $course->short }}">
                    </td> --}}
                    <td style="width:50%">{{ $catagory->title }}</td>
                    {{-- <td>{{ $catagory->details }}</td> --}}
                    <td>{{ $catagory->status }}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{url('/')}}/admin/learn/catagory/view/{{ $catagory->id }}" class="btn btn-info">View</a>
                            <a href="{{url('/')}}/admin/learn/catagory/edit/{{ $catagory->id }}" class="btn btn-warning">Edit</a>
                            @utype('admin')
                            <button class="btn btn-danger" onclick="remove('{{ $catagory->id }}')">Delete</button>
                            @endutype
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
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

            $.post("{{url('/')}}/admin/learn/catagory/short", {_token: '<?php echo csrf_token() ?>',id: cid, short: index}, function(res){
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
        if(confirm('Are you sure? Catagory Id:'+id)){
            $.post('{{url('/')}}/admin/learn/catagory/delete/'+id, {_token: '<?php echo csrf_token() ?>'}, (res)=>{
                // console.log(res);
                if(res.out){
                    location.reload();
                }
            });
        }
    }
</script>

@endsection