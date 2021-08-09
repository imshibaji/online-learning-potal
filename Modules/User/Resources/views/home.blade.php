@extends('layouts.user')

@section('content')
<div id="app" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body" style="min-height: 600px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <x-alert :message="$inspaire" type="info" />

                    <user-main-dashboard></user-main-dashboard>

                    {{-- <x-display /> --}}

                    {{-- <x-video-list :videos="$videos" /> --}}

                    {{-- <x-course-list :courses="$courses" /> --}}

                </div>
            </div>
        </div>
    </div>
</div>


{{-- @include('layouts.modal') --}}
@endsection


@section('headers')
<style>
.block{
    margin: 0px;
}
</style>
@endsection
