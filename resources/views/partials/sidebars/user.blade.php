<nav id="sidebarMenu" class="col-md-4 col-lg-2 d-md-block sidebar custom-sidebar">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column gap-4- sidebar-menu" id="myDiv">
            <div class="text-center pb-3 link fs-6"><b>Customer</b></div>

            <li class="nav-item">
                <a class="nav-link treeview {{ request()->is('dashboard') ? 'bar-active' : '' }}" aria-current="page"
                   href="{{ url('dashboard') }}">
                    <img src="{{ asset('images/DB.svg') }}" alt="">
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link treeview {{ request()->is('service-request-customer*') ? 'bar-active' : '' }}" aria-current="page"
                   href="{{ route('service-request-customer.index') }}">
                    <img src="{{ asset('images/icon/service-feedback.svg') }}" alt="">
                    Service Request
                </a>
            </li>

            {{--<li class="nav-item">
                <a class="nav-link treeview {{ request()->routeIs('nearest.workshop') ? 'bar-active' : '' }}" aria-current="page"
                   href="{{ route('nearest.workshop') }}">
                    <img src="{{ asset('images/icon/nearest-workshop.svg') }}" alt="">
                    Nearest Workshops
                </a>
            </li>--}}

        </ul>

    </div>
</nav>



