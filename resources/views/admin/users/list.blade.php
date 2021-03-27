@extends('admin.users.layout')

@section('usercontent')   
<table class="table">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>WhatsApp</th>
        <th>Pincode</th>
        <th>Utype</th>
        <th class="text-center">Status</th>
        <th class="text-center">Actions</th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->fname }} {{ $user->lname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->mobile }}</td>
            <td>{{ $user->whatsapp }}</td>
            <td>{{ $user->pincode }}</td>
            <td>{{ $user->user_type }}</td>
            <td>
                @if($user->active == 1) Active @else InActive @endIf
                @if($user->isOnline()) <span class="text-success">Online</span> @else <span class="text-danger">Offline</span> @endif
            </td>
            <td class="text-center">
                <div class="btn-group">
                    <a class="btn btn-info" href="{{url('/')}}/admin/user/view/{{$user->id}}">View</a>
                    <a class="btn btn-warning" href="{{url('/')}}/admin/user/edit/{{$user->id}}">Edit</a>
                    @utype('admin')
                    <button class="btn btn-danger" onclick="remove('{{$user->id}}')">Delete</button>
                    @endutype
                </div>
            </td>
        </tr>
    @endforeach
</table>

@endsection

@section('scripts')
<script>
function remove(id){
    if(confirm('User Id:'+id+'. Are you sure?')){
        $.post("{{url('/')}}/admin/user/delete/"+id, {_token: '<?php echo csrf_token() ?>'}, (res)=>{
            console.log(res);
            if(res.out){
                location.reload();
            }
        });
    }
}
</script>
@endsection