<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/larnr.css') }}">
</head>
<body>
<h1>Response</h1>
<div id="notification"></div>

<script src="{{ asset('js/larnr.js') }}"></script>
<script type="text/javascript">
    var i = 0;
    console.log(window);
    window.Echo.channel('user').listen('\\App\\Events\\MyEvent', (data) => {
         console.log(data);
        i++;
        var div = document.createElement('div');
        div.setAttribute('class', 'alert alert-success');
        div.innerHTML = i+' | '+data.message;
        document.querySelector("#notification").appendChild(div);
    });
</script>
</body>
</html>
