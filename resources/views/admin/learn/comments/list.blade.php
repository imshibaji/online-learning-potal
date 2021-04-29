@extends('admin.learn.comments.layout')

@section('contentarea')
    {{-- <table class="table table-hover" id="myTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col">Short</th>
                <th>Course Name</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr id="1">
                <td class="index">1</td>
                <td class="indexInput"><input size="2" readonly type="text" name="short" id="index" value="1"></td>
                <td>Website Designing</td>
                <td>This is the very biggining of the course</td>
                <td>2hours</td>
                <td>active</td>
                <td>
                    <a href="{{url('/')}}/admin/learn/topic/view" class="btn btn-info">View</a>
                    <a href="{{url('/')}}/admin/learn/topic/edit" class="btn btn-warning">Edit</a>
                    <a href="{{url('/')}}/admin/learn/topic/delete" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        </tbody>
    </table> --}}
<div class="container">
    @foreach ($comments as $cmt)
    <div class="media">
        @if($cmt->commentable)
        <img src="{{ url('storage/'.$cmt->commentable->image_path)}}" class="mr-3" width="60px" alt="{{$cmt->commentable->title}}">
        <div class="media-body">
            <h5 class="m-0"><span class="text-success">{{$cmt->commentable->title}}</span></h5>
            <p class="p-0 m-0">{{$cmt->message}}</p>
            <p class="p-0 m-0 ml-3 mb-1">- By {{$cmt->user->fullname()}}</p>
            @if($cmt->replies)
            @foreach ($cmt->replies as $reply)
                <div class="media mt-1 ml-3">
                    {{-- <a class="mr-3" href="#">
                    <img src="..." alt="...">
                    </a> --}}
                    <div class="media-body">
                    <h6 class="m-0">Replied by {{$reply->user->fullname()}}</h6>
                    <p>{{$reply->message}}</p>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
        @endif
    </div>
    @endforeach
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
        $('td.index', ui.item.parent()).each(function (i) {
            $(this).html(i+1);
        });
        $('input[type=text]', ui.item.parent()).each(function (i) {
            $(this).val(i + 1);
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
</script>

@endsection
