<div class="jumbotron jumbotron-fluid" style="background: url(/images/student-girl-2.jpeg);background-repeat: no-repeat;background-size: cover;background-position: 10% 10%;">
    <div class="container">
        <div class="row">
            <div class="col-md-7 p-4" style="background:rgba(15, 15, 15, 0.7);">
                <h4 class="display-6 text-white">Learn Professional Skills from</h4>
                <h1 class="display-4 text-white">Articles and Videos</h1>
                <p class="lead text-white">You can learn skills development tutorials articles and videos from teachers.</p>
                <div class="lead text-white" >
                    <form action="{{route('subscribe')}}" method="POST">
                        @csrf
                        @honeypot
                        @captchaHTML
                        <h5 class="text-white">Subscribe yourself for regular updates</h5>
                        <div class="row">
                          <div class="col-md">
                            <input type="text" name="name" required class="form-control my-1 my-md-0" placeholder="Your Name">
                          </div>
                          <div class="col-md">
                            <input type="email" name="email" required class="form-control my-1 my-md-0" placeholder="Your Email">
                          </div>
                          <div class="col-md">
                            <input type="submit" class="btn btn-primary my-1 my-md-0" value="Subscribe Now">
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
