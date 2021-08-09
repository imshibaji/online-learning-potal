@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Topic View</div>
            <div class="col text-right">
                <a href="{{ route('teachersections.index', ['cid' => $section->course->id]) }}">Back to Sections List</a> |
                <a href="{{ route('teachersections.edit', $section->id) }}">Edit Section</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 py-3">
                <h2>{{$section->title}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <h6>Total {{count($section->topics()->where('status','active')->get())}} Topics</h6>
            </div>
            <div class="col-md-5">
                <h6 class="text-md-right text-center">Do you want to add new Topic?</h5>
            </div>
            <div class="col-md-2 text-center">
                <a href="{{ route('teachertopics.create', ['cid' => $section->course->id, 'sid' => $section->id]) }}" class="btn btn-sm btn-success my-auto">Add Topic</a>
            </div>
        </div>

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th>Section Name</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($section->topics()->orderBy('short','ASC')->get() as $topic)
                <tr>
                    <td class="index">{{$topic->short ?? '#'}}
                        <input type="hidden" name="tid" id="tid" value="{{ $topic->id }}">
                    </td>
                    <td style="width:70%">
                        <p class="p-0 m-0">{{$topic->title}}</p>
                    </td>
                    <td>{{$topic->status}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{route('teachertopics.show', $topic->id)}}" class="btn btn-primary" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{route('teachertopics.edit', $topic->id)}}" class="btn btn-warning" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            @utype('admin')
                            <button class="btn btn-danger" onclick="remove('{{ $topic->id }}')" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            @endutype
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
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
        $('input[type=hidden]', ui.item.parent()).each(function (i) {
            var index = i+1;

            var tid = $(this).val(); // Set Key
            console.log(tid,index); // Get Value

            $.post("{{route('teachertopics.short')}}", {_token: '<?php echo csrf_token() ?>',id: tid, short: index}, function(res){
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
            $.post("{{route('teachertopics.destroy', "+id+")}}", {_token: '<?php echo csrf_token() ?>'}, (res)=>{
                console.log(res);
                if(res.out){
                    location.reload();
                }
            });
        }
    }
</script>
@endsection
