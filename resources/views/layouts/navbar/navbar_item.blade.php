
<div class="navbar-nav navbar-item" id="myDIV">
    <a href="{{route('home')}}" class="nav-item nav-link item-link {{request()->is('/')||request()->is('home')?'new-active':''}}">Home</a>
    {{--<a href="{{route('nearest.workshop')}}" class="nav-item nav-link item-link {{request()->is('nearest-workshop')?'new-active':''}}">Workshops</a>--}}
    <a href="{{ route('design.about-us') }}" class="nav-item nav-link item-link">About Us</a>
    <a href="{{ route('design.contact-us') }}" class="nav-item nav-link item-link">Contact US</a>
    <a href="{{ route('insight') }}" class="nav-item nav-link item-link {{request()->is('insight')?'new-active':''}}">Insight</a>
</div>
