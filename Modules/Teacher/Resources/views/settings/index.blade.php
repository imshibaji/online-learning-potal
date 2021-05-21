@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">Settings</div>
    <div class="card-body">
        @include('teacher::settings.info')
    </div>
</div>
@endsection
