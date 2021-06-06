@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div id="app" class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $title ?? 'Dashboard' }}</div>

                <div id="card_body" class="card-body" style="min-height: 600px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @include('users.learn.main')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('headers')
<link rel="stylesheet" href="{{url('/')}}/css/prism_patched.min.css">
<style>
#accordionExample .card{
    margin-bottom: 0px !important;
}
#accordionExample .card-header{
    padding: 5px !important;
}
#accordionExample .card-body{
    padding: 0px;
    border-bottom: 2px solid #ccc;
}
#accordionExample .card-body .list-group{
    border-radius: 0px;
}
.scroll{
    height: 550px;
    border: 1px solid rgb(8, 140, 216);
    overflow-y: scroll;
}
/* .block1{
    border: 1px solid rgb(8, 140, 216);
    padding: 5px 15px;
    position: relative;
} */


.sticky {
  position: fixed;
  top: 80px;
  width: 326px;
}

</style>
@endsection

@section('scripts')
<script src="{{url('/')}}/js/prism_patched.min.js"></script>
<script>
window.onscroll = function() {myFunction()};

var comment = document.getElementById("comment_section");

var sticky = comment.offsetTop;

function myFunction() {
    if(window.innerWidth > 500){
        if (window.pageYOffset > sticky) {
            comment.classList.add("sticky");
        } else {
            comment.classList.remove("sticky");
        }

        // if(window.pageYOffset > card_height){
        //     comment.classList.add("bottomHeaght");
        // }else{
        //     comment.classList.remove("bottomHeaght");
        // }
    }
}
</script>
@endsection
