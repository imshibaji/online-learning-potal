@extends('admin.users.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/user/list') }}" class="btn btn-primary">User List</a>
        <a href="{{ url('admin/user/edit/'.$user->id) }}" class="btn btn-warning">User Edit</a>
    </div>
@endsection

@section('usercontent') 
{{-- Main Block --}}
@include('admin.users.common.main')

{{-- Section Tabs--}}
 <!-- Nav tabs -->
 <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">All Courses</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#assign">User Assignments</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#reports">Learning Reports</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#comments">Comments / Feedbacks</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#money">Money Trasection</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#gems">Gems Trasection</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#reffers">Reffers</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
        @include('admin.users.common.courselist')
    </div>
    <div id="assign" class="container tab-pane fade"><br>
        @include('admin.users.common.courseassign')
    </div>
    <div id="reports" class="container tab-pane fade"><br>
        @include('admin.users.common.learning_reports')
    </div>
    <div id="comments" class="container tab-pane fade"><br>
        @include('admin.users.common.comments')
    </div>
    <div id="money" class="container tab-pane fade"><br>
        @include('admin.users.common.money')
    </div>
    <div id="gems" class="container tab-pane fade"><br>
        @include('admin.users.common.gems')
    </div>
    <div id="reffers" class="container tab-pane fade"><br>
        @include('admin.users.common.reffers')
    </div>
  </div>
</div>

@endsection

@section('headers')
<style>
#courses .card{
    margin-bottom: 0px !important;
}
#courses .card .card-header{
    padding: 5px;
}
#courses .card .card-body{
    padding: 0px;
}
.input-sm{
    font-size: 12px;
}
</style>   
@endsection