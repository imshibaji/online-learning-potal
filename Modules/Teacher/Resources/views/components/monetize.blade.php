<div class="row">
    <div class="col py-3">
        <canvas id="myChart" width="400" height="100"></canvas>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Revenue Income</div>
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
            <div class="card-header">Income Details</div>
            <div class="card-body py-4">
                <div class="row">
                    <div class="col">Revenue Amount:</div>
                    <div class="col text-right">₹100.00</div>
                </div>
                <div class="row">
                    <div class="col">10% Tax Deduction:</div>
                    <div class="col text-right">₹10.00</div>
                </div>
                <div class="row">
                    <div class="col">12% Service Tax:</div>
                    <div class="col text-right">₹12.00</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col"><h3>Payble Amount:</h3></div>
                    <div class="col text-right"><h3>₹88.00</h3></div>
                </div>
                <p>Payment falls 25 to 30th day of the month in your account.</p>
                <hr>
                <div class="row">
                    <div class="col"><a href="#">Register Your Bank Account</a></div>
                    <div class="col text-right"><span class="text-warning">Not Varified</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
var ctx = $('#myChart');

const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
const data = {
  labels: labels,
  datasets: [{
    label: 'Revenues',
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
