<ul class="navbar-nav ml-auto">
    <!-- Other menu items -->
    @if (Auth::check())
        <li class="nav-item" style="display: flex; align-items: center;">
            <a class="nav-link" href="" style="padding-right: 10px; padding-left: 10px;">Xin chào, {{ Auth::user()->name }}</a>
            <a class="nav-link" href="{{ route('signout') }}" style="padding-right: 10px; padding-left: 10px;"
               onclick="event.preventDefault(); document.getElementById('signout-form').submit();">Đăng xuất</a>
            <form id="signout-form" action="{{ route('signout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logon') }}" style="padding-right: 10px; padding-left: 10px;">Đăng nhập</a>
        </li>
    @endif
</ul>
