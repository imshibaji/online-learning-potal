{{-- <div class="container"> --}}
    @if(count($user->reffers)>0)
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>WhatsApp</th>
            <th>Address</th>
            <th>Details</th>
        </tr>
        @foreach ($user->reffers as $ref)
            <tr>
                <td>{{$ref->fname}} {{$ref->lname}}</td>
                <td>{{$ref->email}}</td>
                <td>{{$ref->mobile}}</td>
                <td>{{$ref->whatsapp}}</td>
                <td>{{$ref->address}}, {{$ref->city}}, {{$ref->pincode}}, {{$ref->state}},{{$ref->country}}</td>
                <td>
                    <a class="btn btn-primary" href="{{url('/')}}/admin/user/view/{{$ref->id}}">View</a>
                </td>
            </tr>
        @endforeach
    </table>
    @else
        <h4 class="text-center">No Refferes</h4>
    @endif
{{-- </div> --}}