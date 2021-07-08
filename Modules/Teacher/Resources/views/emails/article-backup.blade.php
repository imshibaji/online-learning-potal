<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<div style="width: 90%; margin:auto; border:1px solid #ddd;">
    <h3 style="
    background-color: dodgerblue;
    margin:0px; padding:10px;
    color:whitesmoke;
    text-align: center;
    ">{{$article->title}}</h3>

    <div style="padding: 10px">
        <img src="{{$message->embed('storage/'.$article->image_path)}}" width="100%" />
        {{-- <img src="{{url('storage/'.$article->image_path)}}" width="100%" /> --}}
    </div>

    <div style="padding:10px;margin:5px; font-size: 18px;">
        {{$article->description}}
    </div>

    <div style="
        padding:5px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: center;
        align-content: center;
    ">
        <a style="
        background-color: dodgerblue;
        border: 1px solid #00f;
        border-radius: 4px;
        color:whitesmoke;
        padding:10px 80px;
        margin:5px;
        text-decoration: none;
        font-size: 24px;
        display: flex;
        " href="{{'https://larnr.com/article/'.$article->slug}}">Read More</a>
    </div>

    <h5 style="
    background-color: dodgerblue;
    margin:0px; padding:10px;
    color:whitesmoke;
    text-align: center;
    ">Larnr Education</h5>
</div>
</body>
</html>
