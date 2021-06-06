<div class="col-md-3 d-none d-md-block" style="position: relative">
{{-- <div style="position: fixed"> --}}
    <div class="card">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-5 m-0 p-1">
                   <div class="border p-1"><img class="img-fluid" width="190" src="{{ (Auth::user()->teacher->profile_picture)? url('storage/'. Auth::user()->teacher->profile_picture) : url('images/image-upload.jpg') }}"></div>
                </div>
                <div class="col-7 m-0 p-1 pt-2">
                    <h6 class="mb-0">{{Auth::user()->fullname()}}</h6>
                    <p class="m-0"><i class="fa fa-heartbeat " aria-hidden="true"></i> 500</p>
                    @include('teacher::components.star', ['count' => 2.6])
                </div>
            </div>
        </div>
    </div>
    <div class="list-group">
        <a href="{{ route('teacher.home') }}" class="list-group-item list-group-item-action {{ Request::is('/') ? 'active' : '' }}">
            <i class="fa fa-home" aria-hidden="true"></i>
            Dashboard
        </a>
        <a href="{{ route('teacher.page', ['page'=>'profile']) }}" class="list-group-item list-group-item-action {{ Request::is('profile') ? 'active' : '' }}">
            <i class="fa fa-user" aria-hidden="true"></i>
            Profile
        </a>
        <a href="{{ route('teacher.page', ['page'=>'articles']) }}" class="list-group-item list-group-item-action {{ Request::is('articles') ? 'active' : '' }}">
            <i class="fa fa-file-word-o" aria-hidden="true"></i>
            Articles
        </a>
        <a href="{{ route('teacher.page', ['page'=>'courses']) }}" class="list-group-item list-group-item-action {{ Request::is('courses') ? 'active' : '' }}">
            <i class="fa fa-book" aria-hidden="true"></i>
            Courses
        </a>
        <a href="{{ route('teacher.page', ['page'=>'topics']) }}" class="list-group-item list-group-item-action {{ Request::is('teacher/audios') ? 'active' : '' }}">
            {{-- <i class="fa fa-book" aria-hidden="true"></i> --}}
            <i class="fa fa-columns" aria-hidden="true"></i>
            Topics
        </a>
        {{-- <a href="{{ route('teacher.videos') }}" class="list-group-item list-group-item-action {{ Request::is('teacher/videos') ? 'active' : '' }}">
            <i class="fa fa-video-camera" aria-hidden="true"></i>
            Videos
        </a> --}}
        <a href="{{ route('teacher.page', ['page'=>'comments']) }}" class="list-group-item list-group-item-action {{ Request::is('comments') ? 'active' : '' }}">
            <i class="fa fa-comments" aria-hidden="true"></i>
            Comments
        </a>
        <a href="{{ route('teacher.page', ['page'=>'analytics']) }}" class="list-group-item list-group-item-action {{ Request::is('analytics') ? 'active' : '' }}">
            <i class="fa fa-line-chart" aria-hidden="true"></i>
            Analytics
        </a>
        <a href="{{ route('teacher.page', ['page'=>'monetize']) }}" class="list-group-item list-group-item-action {{ Request::is('monetize') ? 'active' : '' }}">
            <i class="fa fa-usd" aria-hidden="true"></i>
            Monetize
        </a>
        <a href="{{ route('teacher.page', ['page'=>'settings']) }}" class="list-group-item list-group-item-action {{ Request::is('settings') ? 'active' : '' }}">
            <i class="fa fa-cogs" aria-hidden="true"></i>
            settings
        </a>
        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"
        onclick="event.preventDefault();document.getElementById('logout-form1').submit();">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            Logout
        </a>
        <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
{{-- </div> --}}
</div>
