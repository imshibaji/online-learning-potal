@extends('admin.learn.catagory.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/learn/catagory/list') }}" class="btn btn-primary">Catagory List</a>
    </div>
@endsection

@section('contentarea')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md">
            <form action="{{route('admincatagoryupdate')}}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{$catagory->id}}">
                <table class="table">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" id="title" name="title" class="form-control" value="{{$catagory->title}}"></td>
                    </tr>
                    <tr>
                        <td>Details</td>
                        <td colspan="3"><input type="text" id="details" name="details" class="form-control" value="{{$catagory->details}}"></td>
                    </tr>
                    <tr>
                        <td>Sub Categories</td>
                        <td colspan="3">
                            <select id="details" name="catagory_id" class="form-control">
                                <option value="0">None</option>
                                @foreach ($catagories as $cat)
                                    <option @if($cat->id == $catagory->catagory_id) selected @endif value="{{$cat->id}}">{{$cat->title}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td colspan="3">
                            <select id="status" name="status" class="form-control">
                                <option value="active" @if($catagory->status =='active') selected @endIf>Active</option>
                                <option value="inactive" @if($catagory->status =='inactive') selected @endIf>InActive</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="3"><input type="submit" class="btn btn-success" value="Submit"></td>
                    </tr>
                </table>
            </form>
            </div>
        </div>
    </div>
@endsection
