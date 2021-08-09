@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Section List</div>
            <div class="col text-right">
                @if($course)
                    <a href="{{ route('teachercourses.show', $course->id) }}">Back to Course View</a> |
                @endif
                <a href="{{ route('teachersections.create') }}">Create new Section</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form class="form-row" action="{{route('teachersections.index')}}" method="get">
            <select name="cid" class="form-control form-control-lg col-9 col-sm-10">
                <option value="0">Select Course</option>
                @foreach ($courses as $crs)
                    @if($course)
                        <option @if($crs->id == $course->id) selected @endif value="{{$crs->id}}">{{$crs->title}}</option>
                    @else
                        <option value="{{$crs->id}}">{{$crs->title}}</option>
                    @endif
                @endforeach
            </select>
            <button type="submit" class="col-3 col-sm-2 btn-lg btn btn-primary mb-2">Get Sections</button>
        </form>
        {{-- Form Part End --}}

        @if($course)
            <div class="row">
                <div class="col-md-12 py-3">
                    <h2>{{$course->title}}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <h6>Total {{count($course->sections()->where('status','active')->get())}} Sections</h6>
                </div>
                <div class="col-md-5">
                    <h6 class="text-md-right text-center">Do you want to add new Section?</h5>
                </div>
                <div class="col-md-2 text-center">
                    <a href="{{ route('teachersections.create', ['cid' => $course->id]) }}" class="btn btn-sm btn-success my-auto">Add Section</a>
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
                @foreach($course->sections()->orderBy('short','ASC')->get() as $section)
                    <tr>
                        <td class="index">{{$section->short ?? '#'}}
                            <input type="hidden" name="tid" id="tid" value="{{ $section->id }}">
                        </td>
                        <td style="width:70%">
                            <h6 class="p-0 m-0">{{$section->title}}</h6>
                            <small class="p-0">{{$section->description}}</small>
                        </td>
                        <td>{{$section->status}}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{route('teachersections.show', $section->id)}}" class="btn btn-primary" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="{{route('teachersections.edit', $section->id)}}" class="btn btn-warning" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @utype('admin')
                                <button class="btn btn-danger" onclick="remove('{{ $section->id }}')" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                @endutype
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
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

            $.post("{{route('teachersections.short')}}", {_token: '<?php echo csrf_token() ?>',id: tid, short: index}, function(res){
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
        if(confirm('Are you sure? Section Id:'+id)){
            $.post("{{route('teachersections.destroy', "+id+")}}", {_token: '<?php echo csrf_token() ?>'}, (res)=>{
                console.log(res);
                if(res.out){
                    location.reload();
                }
            });
        }
    }
</script>
@endsection
