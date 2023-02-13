<nav id="sidebarMenu" class="col-md-4 col-lg-2 d-md-block sidebar collapse custom-sidebar">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column gap-4" id="myDiv">
            <li class="nav-item">
                <a class="nav-link bar-active treeview {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                    href="{{ url('/') }}">
                    <img src="{{ asset('images/DB.svg') }}" alt="">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('workshops*') ? 'active' : '' }}"
                    href="{{ route('workshops.index') }}">
                   <img src="{{ asset('images/DB4.svg') }}" alt="">
                    Workshop
                </a>
            </li>
            <li class="nav-item">
                <div class="nav-link {{ request()->is('/plan') ? 'active' : '' }}"> <img
                        src="{{ asset('images/DB3.svg') }}" alt="">
                    <select class="plan">
                        <option value="">Plan</option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                    </select>
                </div>
            </li>
            <li class="nav-item">
                <div class="nav-link {{ request()->is('/plan') ? 'active' : '' }}"> <img
                        src="{{ asset('images/DB3.svg') }}" alt="">
                    <select class="catagory">
                        <option value="">Service Category</option>
                        <option value="">Cat 01</option>
                        <option value="">Cat 01</option>
                        <option value="">Cat 01</option>
                    </select>
                </div>
            </li>
            <li class="nav-item">
                <div class="nav-link {{ request()->is('/plan') ? 'active' : '' }}"> <img
                        src="{{ asset('images/DB3.svg') }}" alt="">
                    <select class="service">
                        <option value="">Service List</option>
                        <option value="">list 01</option>
                        <option value="">list 01</option>
                        <option value="">list 01</option>
                    </select>
                </div>
            </li>
        </ul>

    </div>
</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    jQuery("#myDiv .nav-link").click(function() {
        jQuery("#myDiv .nav-link").removeClass('bar-active');
        jQuery(this).toggleClass('bar-active');
    });
</script>
