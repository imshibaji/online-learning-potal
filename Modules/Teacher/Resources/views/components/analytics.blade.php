<div class="row">
    <div class="col py-3">
        <canvas id="myChart" width="400" height="100"></canvas>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Articles Visitors</div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      A list item
                      <span class="badge badge-primary badge-pill">14</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      A second list item
                      <span class="badge badge-primary badge-pill">2</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      A third list item
                      <span class="badge badge-primary badge-pill">1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        A third list item
                        <span class="badge badge-primary badge-pill">1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        A third list item
                        <span class="badge badge-primary badge-pill">1</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Course Sales</div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      Course Abc
                      <span class="badge badge-primary badge-pill">14</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      My Acio
                      <span class="badge badge-primary badge-pill">2</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      A third list item
                      <span class="badge badge-primary badge-pill">1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        A third list item
                        <span class="badge badge-primary badge-pill">1</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        A third list item
                        <span class="badge badge-primary badge-pill">1</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
var ctx = $('#myChart');

const labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
const data = {
  labels: labels,
  datasets: [{
    label: 'Articles Visitors',
    data: [65, 59, 80, 81, 56, 55, 40],
    fill: false,
    backgroundColor: 'rgba(75, 192, 192, 0.8)',
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  },{
    label: 'Courses Sales',
    data: [12, 43, 10, 5, 13, 24, 32],
    fill: false,
    backgroundColor: 'rgba(54, 162, 235, 0.8)',
    borderColor: 'rgba(54, 162, 235)',
    tension: 0.1
  }]
};

const config = {
  type: 'line',
  data: data,
}
var myChart = new Chart(ctx, config);
</script>
@endsection
