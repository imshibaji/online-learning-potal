@extends('teacher::layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col">Audios</div>
            <div class="col text-right"><a href="">Create New Audio</a></div>
        </div>
    </div>
    <div class="card-body">
        @component('teacher::components.enquery')
            @slot('name') Shibaji Debnath @endslot
            @slot('email') ixxxxxx@gmail.com @endslot
        @endcomponent
    </div>
</div>
@endsection
