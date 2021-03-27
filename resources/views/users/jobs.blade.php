@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Jobs Section</div>

                <div class="card-body" style="min-height: 600px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 pb-3">
                                <div class="list-group pb-2">
                                    <li class="list-group-item">
                                        <h5>Employess Section</h5>
                                    </li>
                                    <a href="#" class="list-group-item list-group-item-action active">
                                      Recent Jobs Openings
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">My Job Applications</a>
                                    <a href="#" class="list-group-item list-group-item-action">My Saved Jobs</a>
                                </div>

                                <div class="list-group pb-2">
                                    <li class="list-group-item">
                                        <h5>Employer Section</h5>
                                    </li>
                                    <a href="#" class="list-group-item list-group-item-action">Recent Applications</a>
                                    <a href="#" class="list-group-item list-group-item-action">My Jobs Details</a>
                                    <a href="#" class="list-group-item list-group-item-action">Sort Listed Applications</a>
                                    <a href="#" class="list-group-item list-group-item-action">Submit Job Openings</a>
                                </div>

                                {{-- FeedBack --}}
                                <div class="card my-3" id="comment_section">
                                    <div class="card-body">
                                        <h5 class="text-center">Feedback Section</h5>
                                        <div class="form-group">
                                            <label for="Title">Title</label>
                                            <input type="text" class="form-control" id="Title" placeholder="Short Title">
                                        </div>
                                        <div class="form-group">
                                            <label for="Message">Message</label>
                                            <textarea class="form-control" id="Message" placeholder="Comment in Detail"></textarea>
                                        </div>
                                        <input type="submit" class="btn btn-outline-success btn-block" value="Submit" />
                                    </div>
                                </div>
                                {{-- End Feedback --}}
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="text-success p-0 m-0">new</p>
                                                <h2>Website Designer</h2>
                                                <h5>Mndstairs Academy Pvt Ltd</h5>
                                                <p>Kolkata, West Bengal</p>
                                                <p>₹15,000 - ₹20,000 a month</p>
                                                <p>Apply with Indeed ResumeUrgently hiring.<br/>
                                                Job Types: Full-time, Internship, Fresher.<br/>
                                                Salary: ₹15,000.00 to ₹20,000.00 /month.<br/>
                                                Total work: 1 year (Preferred).<br/>
                                                Lead generation: 1 year (Preferred).</p>
                                                <p><small>2 days ago</small> | <a href="#">Save job</a> | <a href="#">More...</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="text-success p-0 m-0">new</p>
                                                <h2>Website Developer</h2>
                                                <h5>Mndstairs Academy Pvt Ltd</h5>
                                                <p>Kolkata, West Bengal</p>
                                                <p>₹15,000 - ₹20,000 a month</p>
                                                <p>Apply with Indeed ResumeUrgently hiring.<br/>
                                                Job Types: Full-time, Internship, Fresher.<br/>
                                                Salary: ₹15,000.00 to ₹20,000.00 /month.<br/>
                                                Total work: 1 year (Preferred).<br/>
                                                Lead generation: 1 year (Preferred).</p>
                                                <p><small>2 days ago</small> | <a href="#">Save job</a> | <a href="#">More...</a> | <a href="#">Apply Now</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="text-success p-0 m-0">new</p>
                                                <h2>Mobile App Developer</h2>
                                                <h5>Mndstairs Academy Pvt Ltd</h5>
                                                <p>Kolkata, West Bengal</p>
                                                <p>₹15,000 - ₹20,000 a month</p>
                                                <p>Apply with Indeed ResumeUrgently hiring.<br/>
                                                Job Types: Full-time, Internship, Fresher.<br/>
                                                Salary: ₹15,000.00 to ₹20,000.00 /month.<br/>
                                                Total work: 1 year (Preferred).<br/>
                                                Lead generation: 1 year (Preferred).</p>
                                                <p><small>2 days ago</small> | <a href="#">Save job</a> | <a href="#">More...</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="text-success p-0 m-0">new</p>
                                                <h2>MEAN Stack Developer</h2>
                                                <h5>Mndstairs Academy Pvt Ltd</h5>
                                                <p>Kolkata, West Bengal</p>
                                                <p>₹15,000 - ₹20,000 a month</p>
                                                <p>Apply with Indeed ResumeUrgently hiring.<br/>
                                                Job Types: Full-time, Internship, Fresher.<br/>
                                                Salary: ₹15,000.00 to ₹20,000.00 /month.<br/>
                                                Total work: 1 year (Preferred).<br/>
                                                Lead generation: 1 year (Preferred).</p>
                                                <p><small>2 days ago</small> | <a href="#">Save job</a> | <a href="#">More...</a></p>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="text-success p-0 m-0">new</p>
                                                <h2>Laravel Developer</h2>
                                                <h5>Mndstairs Academy Pvt Ltd</h5>
                                                <p>Kolkata, West Bengal</p>
                                                <p>₹15,000 - ₹20,000 a month</p>
                                                <p>Apply with Indeed ResumeUrgently hiring.<br/>
                                                Job Types: Full-time, Internship, Fresher.<br/>
                                                Salary: ₹15,000.00 to ₹20,000.00 /month.<br/>
                                                Total work: 1 year (Preferred).<br/>
                                                Lead generation: 1 year (Preferred).</p>
                                                <p><small>2 days ago</small> | <a href="#">Save job</a> | <a href="#">More...</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="text-success p-0 m-0">new</p>
                                                <h2>WordPress Developer</h2>
                                                <h5>Mndstairs Academy Pvt Ltd</h5>
                                                <p>Kolkata, West Bengal</p>
                                                <p>₹15,000 - ₹20,000 a month</p>
                                                <p>Apply with Indeed ResumeUrgently hiring.<br/>
                                                Job Types: Full-time, Internship, Fresher.<br/>
                                                Salary: ₹15,000.00 to ₹20,000.00 /month.<br/>
                                                Total work: 1 year (Preferred).<br/>
                                                Lead generation: 1 year (Preferred).</p>
                                                <p><small>2 days ago</small> | <a href="#">Save job</a> | <a href="#">More...</a></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('headers')
<style>
.sticky {
  position: fixed;
  top: 80px;
  width: 326px;
}
</style>
@endsection

@section('scripts')
<script>
window.onscroll = function() {myFunction()};

var comment = document.getElementById("comment_section");

var sticky = comment.offsetTop;

function myFunction() {
    if(window.innerWidth > 500){
        if (window.pageYOffset > sticky) {
            comment.classList.add("sticky");
        } else {
            comment.classList.remove("sticky");
        }
    }
}
</script>
@endsection