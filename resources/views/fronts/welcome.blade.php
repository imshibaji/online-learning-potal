@extends('layouts.front')

@section('content')
    <div class="contents bottom-line">
        <div class="page-name">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="text-center">Have Your Project work?</h1>
                        <h4 class="text-center">You may findout better Candidates for your work.</h4>
                    </div>
                    <div class="col-md-4 d-none d-md-block">
                        <img src="imgs/smilling_shib.png" alt="Shibaji Debnath">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Area -->
    <div class="page-contents">
        <div class="container">
        <div class="block">
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="jobs">What</label>
                    <input type="text" name="jobs" class="form-control" placeholder="job title, keywords, skills or company">
                </div>
                <div class="col-md-6">
                    <label for="jobs">Where</label>
                    <input type="text" name="places" class="form-control" placeholder="city, state, or pin code">
                </div>
            </div>
            <div class="row mb-3 justify-content-center">
                <div class="col-md-3">
                    <input type="submit" class="mt-4 btn btn-block btn-primary" value="Search">
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Search Area -->

    <!-- Jobs and Employee List -->
    <div class="page-contents">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="articles">
                        <h1 class="text-center text-primary">Candidates List</h1>
                        <!-- User Info -->
                        <div class="block">
                            <div class="ribbon-right"><span>Varified</span></div>
                            <h5>Shibaji Debnath</h5>
                            <p>Skills: Website Design, PHP, PYTHON, MEANSTACK</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="./imgs/smilling_shib.jpg" width="100%">
                                </div>
                                <div class="col-md-8">
                                    <p>Lorem Ipsum is simply dummy the 1500s, when an unknown printer
                                        took a galley versions of Lorem
                                        Ipsum...<a href="#">Read More</a>
                                    </p>

                                    <div class="row">
                                        <div class="col">
                                            <div>Project Rating</div>
                                            <div>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-empty"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>Achievements</div>
                                            <div>
                                                <i class="fa fa-trophy"></i>
                                                <i class="fa fa-safari"></i>
                                                <i class="fa fa-weibo"></i>
                                                <i class="fa fa-balance-scale"></i>
                                                <i class="fa fa-first-order"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- User Info -->

                        <!-- User Info -->
                        <div class="block">
                            <h5>Shibaji Debnath</h5>
                            <p>Skills: Website Design, PHP, PYTHON, MEANSTACK</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="./imgs/smilling_shib.jpg" width="100%">
                                </div>
                                <div class="col-md-8">
                                    <p>Lorem Ipsum is simply dummy the 1500s, when an unknown printer
                                        took a galley versions of Lorem
                                        Ipsum...<a href="#">Read More</a>
                                    </p>

                                    <div class="row">
                                        <div class="col">
                                            <div>Project Rating</div>
                                            <div>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-empty"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>Archivements</div>
                                            <div>
                                                <i class="fa fa-trophy"></i>
                                                <i class="fa fa-safari"></i>
                                                <i class="fa fa-weibo"></i>
                                                <i class="fa fa-balance-scale"></i>
                                                <i class="fa fa-first-order"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- User Info -->

                        <!-- User Info -->
                        <div class="block">
                            <h5>Shibaji Debnath</h5>
                            <p>Skills: Website Design, PHP, PYTHON, MEANSTACK</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="./imgs/smilling_shib.jpg" width="100%">
                                </div>
                                <div class="col-md-8">
                                    <p>Lorem Ipsum is simply dummy the 1500s, when an unknown printer
                                        took a galley versions of Lorem
                                        Ipsum...<a href="#">Read More</a>
                                    </p>

                                    <div class="row">
                                        <div class="col">
                                            <div>Project Rating</div>
                                            <div>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-half-empty"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div>Archivements</div>
                                            <div>
                                                <i class="fa fa-trophy"></i>
                                                <i class="fa fa-safari"></i>
                                                <i class="fa fa-weibo"></i>
                                                <i class="fa fa-balance-scale"></i>
                                                <i class="fa fa-first-order"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- User Info -->

                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="text-center text-primary">Jobs List</h1>

                    <!-- Job List -->
                    <div class="block">
                        <div class="ribbon-right"><span>Featured</span></div>
                        <h3>MEANSTACK Developer Required</h3>
                        <h6><i class="fa fa-map-o"></i> SSPL Kolkata<h6>
                        <h6><i class="fa fa-address-book-o"></i> Salt Lake City, West Bengal</h6>
                        <div><strong>₹15,000 - ₹25,000 a month</strong></div>
                        <p>Lorem Ipsum is simply dummy the 1500s, when an unknown printer
                            took a galley versions of Lorem
                            Ipsum...</p>

                        <div class="row">
                            <div class="col">
                                <a href="#" class="btn btn-link">Apply Now</a>
                                <a href="#" class="btn btn-link text-info">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!-- Job List -->

                    <!-- Job List -->
                    <div class="block">
                        <h3>MEANSTACK Developer Required</h3>
                        <h6><i class="fa fa-map-o"></i> SSPL Kolkata<h6>
                        <h6><i class="fa fa-address-book-o"></i> Salt Lake City, West Bengal</h6>
                        <div><strong>₹15,000 - ₹25,000 a month</strong></div>
                        <p>Lorem Ipsum is simply dummy the 1500s, when an unknown printer
                            took a galley versions of Lorem
                            Ipsum...</p>

                        <div class="row">
                            <div class="col">
                                <a href="#" class="btn btn-link">Apply Now</a>
                                <a href="#" class="btn btn-link text-info">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!-- Job List -->

                    <!-- Job List -->
                    <div class="block">
                        <h3>MEANSTACK Developer Required</h3>
                        <h6><i class="fa fa-map-o"></i> SSPL Kolkata<h6>
                        <h6><i class="fa fa-address-book-o"></i> Salt Lake City, West Bengal</h6>
                        <div><strong>₹15,000 - ₹25,000 a month</strong></div>
                        <p>Lorem Ipsum is simply dummy the 1500s, when an unknown printer
                            took a galley versions of Lorem
                            Ipsum...</p>

                        <div class="row">
                            <div class="col">
                                <a href="#" class="btn btn-link">Apply Now</a>
                                <a href="#" class="btn btn-link text-info">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!-- Job List -->
                </div>
            </div>
        </div>
    </div>
    <!-- Jobs and Employee List -->
@endsection
