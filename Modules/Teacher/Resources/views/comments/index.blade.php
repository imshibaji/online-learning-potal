@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">Articles</div>
    <div class="card-body">
        @component('teacher::components.enquery')
            @slot('name') Shibaji Debnath @endslot
            @slot('email') ixxxxxx@gmail.com @endslot
        @endcomponent
    </div>
</div>
@endsection
