<div class="m-0">
<small class="text-success">{{$count}}</small>
@for ($i = 0; $i < floor($count); $i++)
    <i class="fa fa-star text-success" aria-hidden="true"></i>
@endfor
@if(($count - floor($count)) != 0)
    <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
    @php
        $count++;
    @endphp
@endif
@for ($i=$count; $i < 5; $i++)
    <i class="fa fa-star-o text-success" aria-hidden="true"></i>
@endfor
</div>
<div class="m-0"><a href="{{$reviews_link ?? '#'}}"><span class="text-muted">{{$stared ?? '10'}} Reviews</span></a></div>


