<div class="card">
    <div class="card-header">Visitors Tracking</div>
    <div class="card-body">
        <canvas id="myChart" width="100%" height="70"></canvas>
    </div>
</div>


@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
var ctx = $('#myChart');

const labels = [59,58,57,56,55,54,53,52,51,50,49,48,47,46,45,44,43,42,41,40,39,38,37,36,35,34,33,32,31,30,29,28,27,26,25,24,23,22,21,20,19,18,17,16,15,14,13,12,11,10,9,8,7,6,5,4,3,2,1,0];
const data = {
  labels: labels,
  datasets: [{
    label: 'Live Visitors',
    data: [],
    fill: true,
    backgroundColor: 'rgba(54, 162, 235, 0.8)',
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  }]
};

const config = {
  type: 'bar',
  data: data,
}
var myChart = new Chart(ctx, config);
</script>
@endsection
