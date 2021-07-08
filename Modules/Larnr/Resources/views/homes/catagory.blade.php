<div id="catagory" class="container">
    <div class="row my-5">
        <a href="#" class="col-md-4 px-3 my-2">
            <div class="cat m-0 p-0" style="background-image: url('https://www.plm.automation.siemens.com/media/global/en/is-820219790-640x360_tcm27-49149.jpg');">
                <div class="cat-2 cat-text">Software and Website Development Tutorials</div>
            </div>
        </a>
        <a href="#" class="col-md-4 px-3 my-2">
            <div class="cat m-0 p-0" style="background-image: url('https://assets.pandaily.com/uploads/2020/05/esport-mobile-games.png');">
                <div class="cat-5 cat-text">Mobile Apps and Games Development Tutorials</div>
            </div>
        </a>
        <a href="#" class="col-md-4 px-3 my-2">
            <div class="cat m-0 p-0" style="background-image: url('https://assets.entrepreneur.com/content/3x2/2000/20190820185239-GettyImages-985550942.jpeg');">
                <div class="cat-6 cat-text">Online Digital Marketing and SEO Tutorials</div>
            </div>
        </a>
        <a href="#" class="col-md-4 px-3 my-2">
            <div class="cat m-0 p-0" style="background-image: url('https://darvideo.tv/wp-content/uploads/2019/10/Motion-Design-2.png');">
               <div class="cat-1 cat-text">Graphics and Motion Graphics Design Tutorials</div>
            </div>
        </a>
        <a href="#" class="col-md-4 px-3 my-2">
            <div class="cat m-0 p-0" style="background-image: url('https://www.myamcat.com/blog/wp-content/uploads/2017/11/bd.jpg');">
                <div class="cat-3 cat-text">Business Development Skills Tutorials</div>
            </div>
        </a>
        <a href="#" class="col-md-4 px-3 my-2">
            <div class="cat m-0 p-0" style="background-image: url('https://linesmag.com/wp-content/uploads/2020/04/featured-image-.jpg');">
                <div class="cat-4 cat-text">Art and Craft, Handmade Products Making Tutorials</div>
            </div>
        </a>
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
.cat:hover, a.card .cat-text, #catagory a:hover{
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
