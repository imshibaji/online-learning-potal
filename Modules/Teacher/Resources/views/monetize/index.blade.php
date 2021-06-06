@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">Monetize</div>
    <div class="card-body">
        <h4>Working in Progress...</h4>
        @component('teacher::components.monetize')
            @slot('name') Shibaji Debnath @endslot
            @slot('email') ixxxxxx@gmail.com @endslot
        @endcomponent
    </div>
</div>
@endsection
