@extends('layouts.user')

@section('content')
<div id="app" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Course List</div>

                <div class="card-body" style="min-height: 600px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @php
                            // dd($courses)
                        @endphp
                    {{-- Course List --}}
                        <div class="container-fluid">
                            <div class="row">
                                @forelse ($courses as $learn)
                                {{-- @if($learn->course->status == 'active') --}}
                                <div class="col-12 col-sm-6 col-md-3 block p-2">
                                    <h4 class="text-center m-0">{{ $learn->course->title }}</h4>
                                    <div class="py-2">
                                        <div class="text-justify py-2">
                                            {{$learn->course->meta_desc}}.
                                        </div>
                                        <div class="text-justify p-2">
                                            Duration: {{ $learn->course->duration }}<br/>
                                            Accessible: <strong class="text-success">{{ ucwords($learn->course->accessible) }}</strong>
                                        </div>
                                    </div>
                                    <div class="text-center px-4">
                                        <a href="{{ route('usercdetails', $learn->course->id) }}" class="btn btn-primary btn-block">Learn More</a>
                                    </div>
                                </div>
                                {{-- @endif --}}
                                @empty
                                    <div class="col text-center">
                                        <h1>You do not have own course.</h1>
                                        <p>When you Enrolled Any course. You can get full access.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        {{-- Course List --}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('headers')
<style>
.block{
    margin: 0px;
}
</style>
@endsection
