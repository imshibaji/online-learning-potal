<form action="{{route('admingemsput')}}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <div class="row py-2">
        <div class="col-6">
            <input type="text" name="details" class="form-control" placeholder="Trasection Details">
        </div>
        <div class="col">
            <input type="text" name="gems" class="form-control" placeholder="No of Gems">
        </div>
        <div class="col">
            <select name="type" class="form-control">
                <option value="credit">Add Gems</option>
                <option value="debit">Redeem Gems</option>
                <option value="balance">Balance Gems</option>
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
@foreach ($user->gems()->orderBy('id', 'DESC')->get() as $gem)
<tr>
    <td>{{ $gem->created_at }}</td>
    <td>{{ $gem->details }}</td>
    <td>{{ $gem->addition_gems }}</td>
    <td>{{ $gem->withdraw_gems }}</td>
    <td>{{ $gem->balance_gems }}</td>
</tr>
@endforeach
</table>