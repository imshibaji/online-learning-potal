<div class="container">
    <div class="row my-5">
        {{-- <a href="#" class="card col-md-4 p-0">
            <div class="cat" style="background-image: url('https://www.plm.automation.siemens.com/media/global/en/is-820219790-640x360_tcm27-49149.jpg');">
               <div class="cat-1 cat-text">Graphics and Motion Graphics Design Tutorials</div>
            </div>
        </a> --}}
        <div href="#" class="col-md-4 px-3">
            <div class="cat m-0 p-0" style="background-image: url('https://www.plm.automation.siemens.com/media/global/en/is-820219790-640x360_tcm27-49149.jpg');">
                <div class="cat-2 cat-text">Software and Website Development Tutorials</div>
            </div>
        </div>
        <div href="#" class="col-md-4 px-3">
            <div class="cat m-0 p-0" style="background-image: url('https://www.plm.automation.siemens.com/media/global/en/is-820219790-640x360_tcm27-49149.jpg');">
                <div class="cat-3 cat-text">Mobile Application Development Tutorials</div>
            </div>
        </div>
        <div href="#" class="col-md-4 px-3">
            <div class="cat m-0 p-0" style="background-image: url('https://www.plm.automation.siemens.com/media/global/en/is-820219790-640x360_tcm27-49149.jpg');">
                <div class="cat-4 cat-text">Web Server and Hosting Managment Tutorials</div>
            </div>
        </div>
        {{-- <a href="#" class="card col-md-4 p-0">
            <div class="cat" style="background-image: url('https://www.plm.automation.siemens.com/media/global/en/is-820219790-640x360_tcm27-49149.jpg');">
                <div class="cat-5 cat-text">Games Design and Development Tutorials</div>
            </div>
        </a>
        <a href="#" class="card col-md-4 p-0">
            <div class="cat" style="background-image: url('https://www.plm.automation.siemens.com/media/global/en/is-820219790-640x360_tcm27-49149.jpg');">
                <div class="cat-6 cat-text">Online Digital Marketing and SEO Tutorials</div>
            </div>
        </a> --}}
    </div>
</div>


@section('headers')
@parent
<style>
.card{
    border: 0px !important;
}
.cat{
    background-image: url('https://www.plm.automation.siemens.com/media/global/en/is-820219790-640x360_tcm27-49149.jpg');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 200px;
    text-align: center;
    margin: 10px;
    color:white;
    animation: out 1s forwards;
}
@keyframes in{
    from{
        background-size: 100%;
    }
    to{
        background-size: 120%;
    }
}
@keyframes out{
    from{
        background-size: 120%;
    }
    to{
        background-size: 100%;
    }
}
.cat:hover, a.card .cat-text{
    animation: in 1s forwards;
    text-decoration: none;
}
.cat-1{
    height: 100%;
    background-color: rgba(45, 45, 221, 0.5);
}
.cat-2{
    height: 100%;
    background-color: rgba(0, 132, 219, 0.5);
}
.cat-3{
    height: 100%;
    background-color: rgba(31, 202, 159, 0.5);
}
.cat-4{
    height: 100%;
    background-color: rgba(31, 105, 202, 0.5);
}
.cat-5{
    height: 100%;
    background-color: rgba(145, 9, 127, 0.5);
}
.cat-6{
    height: 100%;
    background-color: rgba(60, 7, 110, 0.5);
}
.cat-text{
    padding-top:13%;
    font-size:30px;
    text-shadow: 2px 2px 4px #000000;
}
</style>
@endsection
