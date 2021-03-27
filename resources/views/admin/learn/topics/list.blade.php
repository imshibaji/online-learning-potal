@extends('admin.learn.topics.layout')

@section('contentarea')
    <table class="table table-hover" id="myTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col">Short</th>
                <th>Topic Name</th>
                <th>Course Name</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Premium</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($topics as $topic)
            @php
                $dur = json_decode($topic->duration, true);
                // var_dump($dur['hours']);
            @endphp
            <tr id="1">
                <td class="index">{{$topic->short ?? '#'}}</td>
                <td class="indexInput">
                    <input type="hidden" name="tid" id="tid" value="{{ $topic->id }}">
                    <input size="2" readonly type="text" name="short" id="index" value="{{ $topic->short }}">
                </td>
                <td>{{ $topic->title }}</td>
                <td>{{ $topic->course->title }}</td>
                <td>{{ $dur['hours'] }}:{{ $dur['minutes'] }}:{{ $dur['seconds'] }} = {{ $dur['totsec'] }}</td>
                <td>{{ $topic->status }}</td>
                <td>{{ $topic->premium_status }}</td>
                <td class="btn-group">
                    <a href="{{url('/')}}/admin/learn/topic/view/{{$topic->id}}" class="btn btn-primary" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a href="{{url('/')}}/admin/learn/topic/edit/{{$topic->id}}" class="btn btn-warning" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    @utype('admin')
                    <button class="btn btn-danger" onclick="remove('{{ $topic->id }}')" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    @endutype
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script>
		var fixHelperModified = function(e, tr) {
		var $originals = tr.children();
		var $helper = tr.clone();
		$helper.children().each(function(index) {
			$(this).width($originals.eq(index).width())
		});
		return $helper;
	},
    updateIndex = function(e, ui) {
        // $('td.index', ui.item.parent()).each(function (i) {
        //     $(this).html(i+1);
        // });
        // $('input[type=text]', ui.item.parent()).each(function (i) {
        //     $(this).val(i + 1);
        // });

        $('input[type=hidden]', ui.item.parent()).each(function (i) {
            var index = i+1;

            var tid = $(this).val(); // Set Key
            console.log(tid,index); // Get Value

            $.post("{{url('/')}}/admin/learn/topic/short", {_token: '<?php echo csrf_token() ?>',id: tid, short: index}, function(res){
                console.log('data shorted', res);
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
        if(confirm('Are you sure? Topic Id:'+id)){
            $.post('{{url('/')}}/admin/learn/topic/delete/'+id, {_token: '<?php echo csrf_token() ?>'}, (res)=>{
                console.log(res);
                if(res.out){
                    location.reload();
                }
            });
        }
    }
</script>

@endsection