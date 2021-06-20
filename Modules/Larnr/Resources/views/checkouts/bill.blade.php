@extends('larnr::layouts.master')

@section('content')
<div class="bg-dark p-1">
<div class="container-fluid">
    <div class="row my-3">
        <div class="col-md-8">
           @include('larnr::checkouts.cart')
        </div>

        <div class="col-md-4">
            @include('larnr::checkouts.customer')
        </div>
    </div>
</div>
</div>
@endsection

@section('headers')
<style>
.back-dark{
    background-color: #343a40;
}
</style>
@endsection
