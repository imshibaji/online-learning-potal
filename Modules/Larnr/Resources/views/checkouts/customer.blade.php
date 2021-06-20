<div class="card">
    <div class="card-header">
        <h5 class="text-center text-secondary">Please input your Billing Information</h5>
    </div>
    <div class="card-body">
        <table class="table">
            <form action="{{route('billpay')}}" method="POST">
                @php
                    $price = $course->actual_price;
                    if($course->offer_price){
                        $price = $course->offer_price;
                    }
                @endphp
                @csrf
                <input type="hidden" name="uid" value="{{Auth::id()}}">
                <input type="hidden" name="cid" value="{{$course->id}}">
                <input type="hidden" name="pps" value="{{$course->title}}">
                <input type="hidden" name="amt" value="{{$price}}">
            <tr>
                <td>Biller Name</td>
                <td><input class="form-control" type="text" name="name" placeholder="Input Biller Name" required value="{{$user->fname ?? ''}}{{ isset($user->lname)? ' '.$user->lname : ''}}"></td>
            </tr>
            <tr>
                <td>Biller Email</td>
                <td><input class="form-control" type="email" name="email" placeholder="Input Biller Email" required value="{{$user->email ?? ''}}"></td>
            </tr>
            <tr>
                <td>Biller Mobile</td>
                <td><input class="form-control" type="number" name="mobile" placeholder="Input Biller Mobile No" required value="{{$user->mobile ?? ''}}"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input class="btn btn-info btn-block" type="submit" value="Checkout Now"></td>
            </tr>
            </form>
        </table>
    </div>
</div>
