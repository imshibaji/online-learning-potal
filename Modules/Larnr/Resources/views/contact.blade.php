@extends('larnr::layouts.master')

@section('content')
<div>
    <img width="100%" src="{{ asset('images/contactus.png') }}" />
</div>
<div class="container">
    <div class="row justify-content-center py-5 my-4">
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
        <div class="col-md-6">
            <h1 class="mt-5">Need Help?</h1>
            <h4>Do you have any Question or Suggestions?</h4>
            <p class="p-0">If you have any question about Our Courses and Articles realated Queries
                and any suggestions put your details with your details and message.</p>
            <h4>Have Any Query About Courses?</h4>
            <p>If you wanted to purchase about courses.
                And you have queries then you can submitted your questions or queries.</p>
        </div>
        <div class="col-md-6 py-3">
            <form action="{{ url('contact') }}" method="post">
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
                    <label for="message" class="form-label">Message (Require)</label>
                    <textarea name="message" class="form-control" id="message" rows="3" placeholder="Your Message" required></textarea>
                </div>
                <button class="btn btn-primary px-5" type="submit">Send Now</button>
            </form>
        </div>
    </div>
</div>
@endsection
