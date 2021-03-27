@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="app" class="card">
                <div class="card-header">{{ $title ?? 'Admin Panel' }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
        
                    <admin-dashboard></admin-dashboard>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection