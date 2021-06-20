{{-- <p class="m-0"><i class="fa fa-heartbeat " aria-hidden="true"></i> {{$follows ?? 0}}</p> --}}
<div class="m-0">
@php
    $count = $star ?? 0;
@endphp
<span class="badge badge-success">{{$language ?? 'Hindi'}}</span>
@for ($i = 0; $i < floor($count); $i++)
    <i class="fa fa-star text-warning" aria-hidden="true"></i>
@endfor
@if(($count - floor($count)) != 0)
    <i class="fa fa-star-half-o text-warning" aria-hidden="true"></i>
    @php
        $count++;
    @endphp
@endif
@for ($i=$count; $i < 5; $i++)
    <i class="fa fa-star-o text-warning" aria-hidden="true"></i>
@endfor
<small class="text-warning">{{$count - 1}}</small>
<span class="text-white">({{$reviews ?? '10'}} Reviews)</span>
<span class="text-white">{{$enrolled ?? '987'}} Students enrolled</span>
</div>


