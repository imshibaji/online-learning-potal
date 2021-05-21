@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">Dashboard</div>
    <div class="card-body">
        <h1>Hello World</h1>
        <p>
            This view is loaded from module: {!! config('teacher.name') !!}
        </p>
        @component('teacher::components.enquery')
            @slot('name') Shibaji Debnath @endslot
            @slot('email') ixxxxxx@gmail.com @endslot
        @endcomponent
    </div>
</div>
@endsection
