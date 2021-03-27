@extends('admin.learn.topics.layout')


@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/learn/comment/list') }}" class="btn btn-primary">Comment List</a>
    </div>
@endsection


@section('contentarea')
<div class="container">
    <div class="row">
        <div class="col">
            {{ $details ?? 'This is the course details section.'}}
        </div>
    </div>
</div>
    <table class="table">
        <tr>
            <th>Topic Name</th>
            <th>Description</th>
            <th>Duration</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>Introduction Website Designing</td>
            <td>This is the very biggining of the course</td>
            <td>2hours</td>
            <td>active</td>
            <td>
                <a href="#" class="btn btn-info">View</a>
                <a href="#" class="btn btn-warning">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    </table>
@endsection