<canvas id="myChart" width="100%" height="70"></canvas>

@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
var ctx = $('#myChart');

const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
const data = {
  labels: labels,
  datasets: [{
    label: 'Visitors',
    data: [65, 59, 80, 81, 56, 55, 40,12, 87],
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
