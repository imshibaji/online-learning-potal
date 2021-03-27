{{-- Main User Info --}}
<div class="container">
<div class="row">
    <div class="col-md">
        <h1>{{ $user->fname }} {{ $user->lname }} | <span class="badge @if($user->active) badge-success @else badge-danger @endif">{{$user->active}}</span>
        <span class="badge @if($user->user_type == 'admin') badge-success @elseif($user->user_type == 'stuff') badge-warning @else badge-info @endif">{{$user->user_type}}</span></h1>
        <div class="row">
            <div class="col">
                <div class="c-callout c-callout-success b-t-1 b-r-1 b-b-1">
                    <small class="text-muted">Joininig Date</small><br>
                    <strong class="h6">{{ $user->created_at }}</strong>
                </div>
            </div>
            <div class="col">
                <div class="c-callout c-callout-primary b-t-1 b-r-1 b-b-1">
                    <small class="text-muted">Last Updated</small><br>
                    <strong class="h6">{{ $user->updated_at }}</strong>
                </div>
            </div>
        </div>
        
        <p>Managed By: {{ $user->manager->fname ?? 'No' }} {{ $user->manager->lname ?? 'Manager' }} | Refered By: {{ $user->reffered->fname ?? 'No' }} {{ $user->reffered->lname ?? 'Referal' }}</p>
        
        <p><i class="fa fa-at"></i>{{ $user->email }}, <i class="fa fa-mobile"></i> {{ $user->mobile }}, <i class="fa fa-whatsapp"></i> {{ $user->whatsapp }}</p>
        <p>Address: {{ $user->address }},{{ $user->city }}, {{ $user->state }}, {{ $user->country }}. Pincode: {{ $user->pincode }}</p>
        {{-- <p>User Type: {{ $user->user_type }}, Active: {{ $user->active }}</p> --}}
        
    </div>
    <div class="col-md">
        <div class="row">
            <div class="col">
                <h2 class="text-center">Last Trasections Informations</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="c-callout c-callout-success b-t-1 b-r-1 b-b-1">
                    <small class="text-muted">Total Gems</small><br>
                    <strong class="h4">{{ $user->gems->sum('addition_gems') }}</strong>
                </div>
            </div>
            <div class="col">
                <div class="c-callout c-callout-warning b-t-1 b-r-1 b-b-1">
                    <small class="text-muted">Total Redeem</small><br>
                    <strong class="h4">{{ $user->gems->sum('withdraw_gems') }}</strong>
                </div>
            </div>
            <div class="col">
                <div class="c-callout c-callout-info b-t-1 b-r-1 b-b-1">
                    <small class="text-muted">Balance Gems:</small><br>
                    <strong class="h4">{{ $gem->balance_gems ?? 0 }}</strong>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="c-callout c-callout-success b-t-1 b-r-1 b-b-1">
                    <small class="text-muted">Total Paid</small><br>
                    <strong class="h4">{{ $user->money->sum('addition_amt') }}</strong>
                </div>
            </div>
            <div class="col">
                <div class="c-callout c-callout-warning b-t-1 b-r-1 b-b-1">
                    <small class="text-muted">Total Redeem</small><br>
                    <strong class="h4">{{ $user->money->sum('withdraw_amt') }}</strong>
                </div>
            </div>
            <div class="col">
                <div class="c-callout c-callout-info b-t-1 b-r-1 b-b-1">
                    <small class="text-muted">Balance Amt:</small><br>
                    <strong class="h4">{{ $money->balance_amt ?? 0 }}</strong>
                </div>
            </div>
        </div>
        {{-- End --}}
    </div>
</div>
</div>
{{-- Main User Info --}}