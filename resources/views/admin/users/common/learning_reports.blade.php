<form action="{{route('assignlearning')}}" method="POST" name="learning_form">
@csrf
<input type="hidden" name="lid" value="{{ $learn->id ?? '' }}">
<input type="hidden" name="user_id" value="{{ $user->id }}">
<div>
    <h2>Learning and Skill Sets</h2>
    <div class="row p-2">
        <div class="col-8">
            <input type="text" name="title" class="form-control" placeholder="Title" value="{{$learn->title ?? ''}}">
        </div>
        <div class="col-4">
            <input type="text" name="total_learning_length" class="form-control" placeholder="Learning Length" value="{{$learn->total_learning_length ?? ''}}">
        </div>
    </div>
    <div class="row p-2">
        <div class="col">
            <input type="text" name="message" class="form-control" placeholder="Message" value="{{$learn->message ?? ''}}">
        </div>
    </div>
    <div class="row p-2">
        <div class="col">
            <input type="text" name="skills" class="form-control" placeholder="Skills" value="{{$learn->skills ?? ''}}">
        </div>
        <div class="col">
            <input type="text" name="tasks" class="form-control" placeholder="Tasks" value="{{$learn->tasks ?? ''}}">
        </div>
        <div class="col">
            <input type="text" name="learning_points" class="form-control" placeholder="Learning Points" value="{{$learn->learning_points ?? ''}}">
        </div>
    </div>
    <div class="row p-2">
        <div class="col">
            <input type="text" name="design_points" class="form-control" placeholder="Total Design Points" value="{{ $learn->design_points ?? ''}}">
        </div>
        <div class="col">
            <input type="text" name="developing_points" class="form-control" placeholder="Total Developing Points" value="{{ $learn->developing_points ?? ''}}">
        </div>
        <div class="col">
            <input type="text" name="debugging_points" class="form-control" placeholder="Total Debugging Points" value="{{ $learn->debugging_points ?? ''}}">
        </div>
    </div>
</div>

<div>
    <div class="row p-2">
        <div class="col-6 col-md-3">
            <input type="text" name="reports_chart[task_name]" class="form-control" placeholder="Task Name">
        </div>
        <div class="col-6 col-md-3">
            <input type="text" name="reports_chart[design_point]" class="form-control" placeholder="Designing Points">
        </div>
        <div class="col-6 col-md-3">
            <input type="text" name="reports_chart[develop_points]" class="form-control" placeholder="Development Points">
        </div>
        <div class="col-6 col-md-3">
            <input type="text" name="reports_chart[debug_points]" class="form-control" placeholder="Debugging Points">
        </div>
        <div class="col p-3">
            <input type="submit"  class="btn btn-success btn-block" value="Submit">
        </div>
    </div>
</div>
</form>


{{-- Learning Assesment --}}
<div>
    <h3>Learning Assesments</h3>
    <table class="table">
        <tr>
            <th>Tasks Name:</th>
            <th>Design</th>
            <th>Developing</th>
            <th>Debugging</th>
            <th>Total Points</th>
        </tr>
        @foreach ($charts as $chart)
        <tr>
            <td>{{ $chart->task_name }}</td>
            <td>{{ $chart->design }}</td>
            <td>{{ $chart->develop }}</td>
            <td>{{ $chart->debug }}</td>
            <td>{{ $chart->design + $chart->develop + $chart->debug }}</td>
        </tr>
        @endforeach
    </table>
</div>