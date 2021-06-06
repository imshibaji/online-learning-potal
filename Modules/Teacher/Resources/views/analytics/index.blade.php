@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">Analytics</div>
    <div class="card-body">
        <h4>Working in Progress...</h4>
        @component('teacher::components.analytics')
            @slot('name') Shibaji Debnath @endslot
            @slot('email') ixxxxxx@gmail.com @endslot
        @endcomponent
    </div>
</div>
@endsection
