@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4>{{ $title ?? 'Admin Panel' }}</h4>
                        </div>
                        @section('quickbtn')
                            <div class="col text-right">
                                <a href="{{url('/')}}/admin/user/add" class="btn btn-primary">Add New User</a>
                            </div>
                        @show
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @section('usercontent')   
                    @show
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
