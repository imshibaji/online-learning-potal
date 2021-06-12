@php
    $reviews = $testimonials ?? [
        ['image' => 'imgs/philip.jpg', 'name' => 'Suman', 'desc' => 'this is the very good expariences'],
        ['image' => 'imgs/jane.jpg', 'name' => 'Loli', 'desc' => 'this is the very good expariences'],
        ['image' => 'imgs/john.jpg', 'name' => 'Sujit', 'desc' => 'this is the very good expariences'],
        ['image' => 'imgs/philip.jpg', 'name' => 'Suman', 'desc' => 'this is the very good expariences'],
        ['image' => 'imgs/jane.jpg', 'name' => 'Loli', 'desc' => 'this is the very good expariences'],
        ['image' => 'imgs/john.jpg', 'name' => 'Sujit', 'desc' => 'this is the very good expariences'],
        ['image' => 'imgs/philip.jpg', 'name' => 'Suman', 'desc' => 'this is the very good expariences'],
        ['image' => 'imgs/jane.jpg', 'name' => 'Loli', 'desc' => 'this is the very good expariences'],
        ['image' => 'imgs/john.jpg', 'name' => 'Sujit', 'desc' => 'this is the very good expariences'],
    ];
    $count = count($reviews);
    $pages = ceil($count/3);
    $init = 0;
@endphp

<!-- testimonial start -->
<div class="testimonial py-5 mb-5" style="background-color: rgb(217, 235, 252)">
    <div class="container">
    <h2 class="text-center p-0 m-0"><u>Top Teachers</u></h2>

      <!-- Carausal Content -->
      <div id="carouselTeacherSlidesOnly" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @for($i=0; $i<$pages; $i++)
                <li data-target="#carouselTeacherSlidesOnly" data-slide-to="{{$i}}" {{$i==0? 'class="active"' : null }}></li>
            @endfor
        </ol>
        <div class="carousel-inner">
        @for($i=0; $i<$pages; $i++)
          <div class="carousel-item {{$i==0 ? 'active' : null}}">
            <div class="flex-container">
              <div class="flexback m-4 row">
                @for ($j=0; $j<3; $j++)
                    @if($init < $count)
                    <div class="col-md my-2 my-md-0">
                        @component('larnr::components.teacher')
                            @slot('image') {{ $reviews[$init]['image'] }} @endslot
                            @slot('name') {{ $reviews[$init]['name'] }} @endslot
                            @slot('desc') {{ $reviews[$init]['desc'] }} @endslot
                        @endcomponent
                        @php $init++ @endphp
                    </div>
                    @endif
                @endfor
              </div>
            </div>
          </div>
        @endfor
        </div>
      </div>
      <!--End Carausal Content -->
    </div>
</div>
<!-- testimonial end -->
