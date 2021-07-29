<div class="avatar-circle" style="width:{{$size}};height:{{$size}}">
    <span class="initials">{{$fl}}{{$ll}}</span>
</div>
@section('headers')
@parent
<style>
    .avatar-circle {
      background-color: rgb(34, 34, 34);
      text-align: center;
      border-radius: 50%;
      -webkit-border-radius: 50%;
      -moz-border-radius: 50%;
    }
    .initials {
      position: relative;
      top: 15%; /* 25% of parent */
      font-size: 100%; /* 50% of parent */
      line-height: 100%; /*50% of parent */
      color: #fff;
      font-family: "Courier New", monospace;
      font-weight: bold;
    }
</style>
@endsection
