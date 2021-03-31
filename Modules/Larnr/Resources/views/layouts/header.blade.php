<nav class="navbar navbar-expand-md navbar-dark bg-blue fixed-top">
    <div class="d-flex flex-grow-1">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{ url('/') }}/images/logo-dark.png" class="logo-img">
            {{-- Larnr Education --}}
        </a>
        <form class="mr-2 my-auto w-100 d-none d-sm-inline-block order-1">
            <div class="input-group">
                <input type="text" class="form-control border border-right-0" placeholder="Search...">
                <span class="input-group-append">
                    <button class="btn btn-outline-light border border-left-0" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
    </div>
    <button class="navbar-toggler order-0" type="button" data-toggle="collapse" data-target="#navbar7">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse flex-shrink-1 flex-grow-0 order-last" id="navbar7">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link hover-nav" href="https://app.larnr.com/login">Login</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link hover-nav" href="https://app.larnr.com">Free Registration</a>
            </li>
        </ul>
    </div>
</nav>
