<nav id="sidebarMenu" class="col-md-4 col-lg-2 d-md-block sidebar custom-sidebar">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column gap-4- sidebar-menu" id="myDiv">
            <div class="text-center pb-3 link fs-6"><b>Workshop</b></div>

            <li class="nav-item">
                <a class="nav-link treeview main-link {{ request()->is('dashboard') ? 'bar-active' : ' ' }}" aria-current="page"
                   href="{{ url('dashboard') }}">
                    <img src="{{ asset('images/DB.svg') }}" alt="">
                    Dashboard
                </a>
            </li>



            <li class="treeview {{request()->is('service-list*')?'active':''}}">
                <a href="#" class="nav-link main-link {{request()->is('service-list*')?'bar-active':''}}">
                    <img src="{{ asset('images/icon/service-list.svg') }}" alt=""><span>Service List</span>
                    <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: {{ request()->is('service-lis*') ? 'block' : 'none' }}">
                    <li class="">
                        <a class="nav-link {{request()->is('service-list*')?'list-active':''}}" href="{{route('service-list.index')}}">
                            Service List
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link treeview {{request()->is('service-request*')?'bar-active':''}} main-link" aria-current="page"
                   href="{{ route('service-request.index') }}">
                    <img src="{{ asset('images/icon/service-req.svg') }}" alt="">
                    Service Request
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link treeview {{request()->is('service-feedback*')?'bar-active':''}} main-link" aria-current="page"
                   href="{{ route('service-feedback.index') }}">
                    <img src="{{ asset('images/icon/service-feedback.svg') }}" alt="">
                    Service Feedback
                </a>
            </li>


            {{--<li class="nav-item">
                <a class="nav-link treeview {{ request()->routeIs('nearest.workshop') ? 'bar-active' : '' }} main-link" aria-current="page"
                   href="{{ route('nearest.workshop') }}">
                    <img src="{{ asset('images/icon/nearest-workshop.svg') }}" alt="">
                    Nearest Workshops
                </a>
            </li>--}}

        </ul>

    </div>
</nav>



