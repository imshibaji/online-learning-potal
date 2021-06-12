<div class="textbox py-4 row">
    <div class="col-4">
        <img  src="{{ $image ?? '/imgs/john.jpg' }}">
    </div>
    <div class="col-8">
        <h5 class="pt-3">{{ $name ?? 'John' }}</h5>
        @include('larnr::components.star', ['star' => $star ?? rand(20,50)/10, 'reviews' => $reviews ?? rand(1,50)])
    </div>
    <div class="col-12">
        <p class="pt-0 text-center">{{ $desc ?? 'This is the sample text' }}</p>
    </div>
</div>
