@extends('admin.learn.course.layout')


@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/learn/course/list') }}" class="btn btn-primary">Course List</a>
    </div>
@endsection


@section('contentarea')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>{{$course->title}}</h1>
            <div>{!! $course->details !!}</div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-5">
            <h3>Topics List</h3>
        </div>
        <div class="col-md-5">
            <h4 class="text-md-right text-center">Do you want to add new topic?</h5>
        </div>
        <div class="col-md-2 text-center">
            <a href="{{ url('admin/learn/topic/add?course='.$course->id) }}" class="btn btn-success">Add Topic</a>
        </div>
    </div>
</div>
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                {{-- <th scope="col">Short</th> --}}
                <th>Topic Name</th>
                {{-- <th>Description</th> --}}
                <th>Duration</th>
                <th>Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($course->topics()->orderBy('short','ASC')->get() as $topic)
            <tr>
                <td class="index">{{$topic->short ?? '#'}}
                    <input type="hidden" name="tid" id="tid" value="{{ $topic->id }}">
                </td>
                {{-- <td class="indexInput">

                    <input size="2" readonly type="text" name="short" id="index" value="{{ $topic->short }}">
                </td> --}}
                <td style="width:50%">{{$topic->title}}</td>
                {{-- <td>{{ substr($topic->details, 0, 60) }}</td> --}}
                <td>
                    @php
                        $dur = json_decode($topic->duration, true);
                    @endphp
                    {{ $dur['totsec'] }}
                </td>
                <td>{{$topic->status}}</td>
                <td class="text-center">
                    <div class="btn-group">
                        <a href="{{url('/')}}/admin/learn/topic/view/{{$topic->id}}" class="btn btn-primary" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a href="{{url('/')}}/admin/learn/topic/edit/{{$topic->id}}" class="btn btn-warning" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        @utype('admin')
                        <button class="btn btn-danger" onclick="remove('{{ $topic->id }}')" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
