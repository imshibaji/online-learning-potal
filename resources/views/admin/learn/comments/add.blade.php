@extends('admin.learn.comments.layout')

@section('quickbtn')
    <div class="col text-right">
        <a href="{{ url('admin/learn/comment/list') }}" class="btn btn-primary">Comment List</a>
    </div>
@endsection

@section('contentarea')
<table class="table">
    <tr>
        <td>Name</td>
        <td><input type="text" name="name" class="form-control"></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><textarea name="desc" id="editor" class="form-control"></textarea></td>
    </tr>
    <tr>
        <td>Duration</td>
        <td><input type="text" name="duration" class="form-control"></td>
    </tr>
    <tr>
        <td>Status</td>
        <td>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">InActive</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="submit" class="btn btn-success" value="Submit"></td>
    </tr>
</table>
@endsection

@section('scripts')
<script>
window.onload = function(){
    CKEDITOR.replace('editor');
}
</script>
@endsection