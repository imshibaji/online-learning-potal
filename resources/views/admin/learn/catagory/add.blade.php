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
            <form action="{{route('admincatagorycreate')}}" method="POST">
                @csrf
                <table class="table">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" id="title" name="title" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Details</td>
                        <td colspan="3">
                            <input type="text" id="details" name="details" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Sub Categories</td>
                        <td colspan="3">
                            <select id="details" name="catagory_id" class="form-control">
                                <option value="0">None</option>
                                @foreach ($catagories as $catagory)
                                    <option @if($cat_id !=null && $cat_id==$catagory->id) selected @endif value="{{$catagory->id}}">{{$catagory->title}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td colspan="3">
                            <select id="status" name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">InActive</option>
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
