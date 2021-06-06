@extends('admin.learn.questions.layout')

@section('contentarea')
    <table class="table table-hover" id="myTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col">Short</th>
                <th>Question</th>
                <th>Topic</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $question)
            @php
                $dur = json_decode($question->duration, true);
                // var_dump($dur['hours']);
            @endphp
            <tr id="1">
                <td class="index">{{$question->short ?? '#'}}</td>
                <td class="indexInput">
                    <input type="hidden" name="qid" id="qid" value="{{ $question->id }}">
                    <input size="2" readonly type="text" name="short" id="index" value="{{ $question->short }}">
                </td>
                <td>{{ $question->question }}</td>
                <td>{{ $question->topic->title }}</td>
                <td>{{ $dur['hours'] }}:{{ $dur['minutes'] }}:{{ $dur['seconds'] }} = {{ $dur['totsec'] }}</td>
                <td>{{ $question->status }}</td>
                <td class="btn-group">
                    <a href="{{url('/')}}/admin/learn/question/view/{{ $question->id }}" class="btn btn-info">View</a>
                    <a href="{{url('/')}}/admin/learn/question/edit/{{ $question->id }}" class="btn btn-warning">Edit</a>
                    <button class="btn btn-danger" onclick="remove('{{ $question->id }}')">Delete</button>
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

            var qid = $(this).val(); // Set Key
            console.log(qid,index); // Get Value

            $.post("{{url('/')}}/admin/learn/question/short", {_token: '<?php echo csrf_token() ?>',id: qid, short: index}, function(res){
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
        if(confirm('Are you sure? Question Id:'+id)){
            $.post('{{url('/')}}/admin/learn/question/delete/'+id, {_token: '<?php echo csrf_token() ?>'}, (res)=>{
                console.log(res);
                if(res.out){
                    location.reload();
                }
            });
        }
    }
</script>

@endsection
