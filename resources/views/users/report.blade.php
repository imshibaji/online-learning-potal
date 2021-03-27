@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div id="app" class="col-md-12">
            <div class="card">
                <div class="card-header">Skills and Activity Tracker</div>

                <div class="card-body" style="min-height: 600px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <user-report-dashboard />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
