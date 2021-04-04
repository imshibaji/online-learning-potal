@extends('admin.users.layout')

@section('usercontent')
<table class="table">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Pincode</th>
        <th>Utype</th>
        <th class="text-center">Status</th>
        <th class="text-center">Actions</th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->fname }} {{ $user->lname }}</td>
            <td>
                <div class="form-check form-check-inline">
                    {{ $user->email }}
                    @if($user->email_verified_at != null)
                        <span class="text-success"><i class="fa fa-check"></i></span>
                    @else
                        <span class="text-danger"><i class="fa fa-exclamation"></i></span>
                    @endif
                </div>
            </td>
            <td>
                <div><i class="fa fa-mobile"></i> {{ $user->mobile }}</div>
                <div><i class="fa fa-whatsapp"></i> {{ $user->whatsapp ?? 'None' }}</div>
            </td>
            <td class="text-center">
                <div>{{ $user->country ?? 'none' }}</div>
                <div>{{ $user->pincode }}</div>
            </td>
            <td>{{ $user->user_type }}</td>
            <td>
                <div>@if($user->active == 1) Active @else InActive @endIf</div>
                <div>@if($user->isOnline()) <span class="text-success">Online</span> @else <span class="text-danger">Offline</span> @endif</div>
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
