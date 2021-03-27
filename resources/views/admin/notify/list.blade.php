@extends('admin.notify.layout')

@section('usercontent')
<table class="table">
    <thead>
      <tr>
        <th scope="col">Title</th>
        <th scope="col">Created By</th>
        <th scope="col">Time</th>
        <th scope="col">Sended?</th>
        <th scope="col">Type</th>
        <th scope="col">For</th>
        <th class="text-center" scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($notifies as $notify)
        <tr>
          <th style="width:30%">{{ $notify->title }}</th>
          <td>{{ $notify->user->fname }} {{ $notify->user->lname }}</td>
          <td>{{ $notify->sending_time }}</td>
          <td>{{ $notify->sending_status }}</td>
          <td>{{ $notify->notify_type }}</td>
          <td>{{ $notify->user_type }}</td>
          <td class="text-center">
            <div class="btn-group">
              <a href="{{route('adminnotifyview', $notify->id)}}" class="btn btn-primary" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
              <a href="{{route('adminnotifyedit', $notify->id)}}" class="btn btn-warning" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              <a href="{{route('adminnotifydelete', $notify->id)}}" class="btn btn-danger" title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection