@extends('admin.learn.questions.layout')


@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/learn/topic/view/'.$question->topic->id) }}" class="btn btn-primary">Question List</a>
        @if(isset($topic_id))
            <a href="{{ url('admin/learn/topic/view/'.$topic_id) }}" class="btn btn-warning">Back To Topic</a>
        @endif
    </div>
@endsection


@section('contentarea')
<div class="container">
    <div class="row">
        <div class="col">
            {{-- {{ $question }} --}}
            {!! $question->question !!}
        </div>
    </div>
    <div class="row">
        <div class="col">
            @php
                $opts = json_decode($question->opt);
                // var_dump($opts);
            @endphp
            <form name="quest" onsubmit="return submitDatas(this)">
                @if($question->qtype == 1)
                    @foreach ($opts as $key => $val)
                        <div>
                            <label>{{$key + 1}}. <input type="radio" name="ans[]" value="{{$key + 1}}">
                            {{ $val }}</label>
                        </div>
                    @endforeach
                @elseIf($question->qtype == 2)
                    @foreach ($opts as $key => $val)
                        <div>
                            <label>{{$key + 1}}. <input type="checkbox" name="ans[]" value="{{$key + 1}}">
                            {{ $val }}</label>
                        </div>
                    @endforeach
                @elseIf($question->qtype == 3)
                        <div class="py-2">
                            <textarea class="form-control" name="ans[]"></textarea>
                        </div>
                @endIf
                <input type="submit" class="btn btn-success" value="Submit">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col p-3">
            <div id="report"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function submitDatas(){
    var anss=[];
    var dataans = JSON.parse(@json($question->ans));
    var answer = `{!! $question->answer !!}`;
    $("input:checkbox[name='ans[]']:checked").each(function(){
        anss.push($(this).val());
    });
    $("input:radio[name='ans[]']:checked").each(function(){
        anss.push($(this).val());
    });
    console.log(anss.length, dataans);


    for(var i=0; i<anss.length; i++){
        // console.log(anss[i], dataans[i]);
        var found = dataans.find((el) => {
            if(el == anss[i]){
                $('#report').append('<p class="text-success">No '+anss[i]+' is a correct answer.</p>');
                return true;
            }
            return false;
        });

        if(!found){
            $('#report').append('<p class="text-danger">No '+anss[i]+' is a wrong answer.</p>');
        }
    }

    if(anss.length>0){
        $("input").prop('disabled', true);
        $('#report').append('<div class="text-default"><h4>Answer:</h4>'+answer+'</div>');
    }

    return false;
}
</script>
@endsection
