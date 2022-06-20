@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Topic View</div>
            <div class="col text-right">
                @if($course)
                    <a href="{{ route('teachercourses.show', $course->id) }}">Back to Course View</a> |
                @endif
                <a href="{{ route('teachertopics.create') }}">Create new Topic</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form class="form-row" action="{{route('teachertopics.index')}}" method="get">
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
            <button type="submit" class="col-3 col-sm-2 btn-lg btn btn-primary mb-2">Get Topics</button>
        </form>
        {{-- Form Part End --}}

        @if($course)
            <div class="row">
                <div class="col-md-12 py-3">
                    <h2>{{$course->title}}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 py-2">
                    <h6>Total {{count($course->topics()->where('status','active')->get())}} Topics</h6>
                </div>
                <div class="col-md-5 py-2">
                    <h6 class="text-md-right text-center">Do you want to add new topic?</h5>
                </div>
                <div class="col-md-2 text-center pb-2">
                    <a href="{{ route('teachertopics.create', ['cid' => $course->id]) }}" class="btn btn-sm btn-success my-auto">Add Topic</a>
                </div>
            </div>
            {{-- Sections --}}
            <div class="accordion" id="accordionExample">
            @foreach ($course->sections()->orderBy('short')->get() as $k=> $section)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{$section->id}}">
                  <button class="accordion-button {{ ($k==0)? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$section->id}}" aria-expanded="{{ ($k==0)? 'true' : 'false' }}" aria-controls="collapse{{$section->id}}">
                    {{$section->title}}
                  </button>
                </h2>
                <div id="collapse{{$section->id}}" class="accordion-collapse collapse {{ ($k==0)? 'show' : 'hide' }}" aria-labelledby="heading{{$section->id}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    {{-- <th scope="col">Short</th> --}}
                                    <th>Topic Name</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Preview</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($section->topics()->orderBy('short','ASC')->get() as $topic)
                                <tr>
                                    <td class="index">{{$topic->short ?? '#'}}
                                        <input type="hidden" name="tid" id="tid" value="{{ $topic->id }}">
                                    </td>
                                    <td style="width:50%">
                                    <p class="p-0 m-0">{{$topic->title}}</p>
                                    {{-- <small class="p-0 m-0">{{$topic->section->title ?? 'None'}}</small> --}}
                                    </td>
                                    <td>
                                        @php
                                            $dur = json_decode($topic->duration);
                                        @endphp
                                        {{ $dur->hours? $dur->hours.': ' : ''.$dur->minutes.':'.$dur->seconds.'' }}
                                    </td>
                                    <td>{{$topic->status}}</td>
                                    <td class="text-center">
                                        @if($topic->premium_status=='free')
                                            <i class="fa fa-check fa-lg text-success" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-lock fa-lg text-warning" aria-hidden="true"></i>
                                        @endif
                                    </td>
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
            </div>
            @endforeach
            </div>

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
<script>
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


{{-- @section('scripts')
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
@endsection --}}
