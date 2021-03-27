<form action="{{route('adminmoneyput')}}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <div class="row py-2">
        <div class="col-6">
            <input type="text" name="details" class="form-control" placeholder="Trasection Details">
        </div>
        <div class="col">
            <input type="text" name="amount" class="form-control" placeholder="Amount">
        </div>
        <div class="col">
            <select name="type" class="form-control">
                <option value="credit">Add Fund</option>
                <option value="debit">Redeem Fund</option>
                <option value="balance">Balance Fund</option>
            </select>
        </div>
    </div>
    <div class="row p-2">
        <button class="btn btn-success btn-block">Submit</button>
    </div>
</form>
    
    
{{-- Details Table --}}
<table class="table">
<tr>
    <th>Trasection Date and Time</th>
    <th>Details</th>
    <th>Addition</th>
    <th>Redeems</th>
    <th>Balance</th>
</tr>
@foreach ($user->money()->orderBy('id', 'DESC')->get() as $m)
    <tr>
        <td>{{ $m->created_at }}</td>
        <td>{{ $m->details }}</td>
        <td>{{ $m->addition_amt }}</td>
        <td>{{ $m->withdraw_amt }}</td>
        <td>{{ $m->balance_amt }}</td>
    </tr>
@endforeach
</table>