@extends('larnr::layouts.master')

@section('content')
@include('larnr::partners.display')
<div class="container">
    <div class="row justify-content-center py-md-3 my-md-3">
        @if(session('status'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ session('status') }}</strong>
                </div>
                <script>
                $(".alert").alert();
                </script>
            </div>
        @endif
        <div class="col-md-6 pt-md-4">
            <h1 class="mt-md-5">Benifits with us.</h1>
            <h4>Share Your Articles</h4>
            <p>You can get earning from tutorial articles.
                Join Our Parnership Programm.</p>

            <h4>Sell Your Courses</h4>
            <p>You can sell from your courses. Also You can get earnings from your courses.
                You don't need to pay any platform fees.
            </p>

            <h4>Boosting your content</h4>
            <p>We are booting your articles without any charges and also get earning from partnership programs.
                Also We are charges only 30% of your course sales amount.</p>
        </div>
        <div class="col-md-6 py-3">
            <form action="{{ url('partner') }}" method="post">
                @csrf
                @captchaHTML
                <div class="mb-3">
                    <label for="name" class="form-label">Full name (Require)</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your name" required>
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile Number (Optional)</label>
                    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Your Mobile Number">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address (Require)</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Expertise Topics (Require)</label>
                    <input type="text" name="subject" class="form-control" id="subject" placeholder="Your Expertise on Topics" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Why you wanted to join US? (Require)</label>
                    <textarea name="message" class="form-control" id="message" rows="3" placeholder="Your Message" required></textarea>
                </div>
                <button class="btn btn-primary px-5" type="submit">Send Now</button>
            </form>
        </div>
    </div>
</div>
@endsection
