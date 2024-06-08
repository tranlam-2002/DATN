<ul class="navbar-nav ml-auto">
  @if (Auth::check())
    <li class="nav-item" style="display: flex; align-items: center;">
      <a class="nav-link" href="" style="padding-right: 10px; padding-left: 10px;">Xin chào, {{ Auth::user()->name }}</a>
      <a class="nav-link" href="{{ route('logout') }}" style="padding-right: 10px; padding-left: 10px;"
         onclick="event.preventDefault(); document.getElementById('signout-form').submit();">Đăng xuất</a>
      <form id="signout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </li>
  @else
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}" style="padding-right: 10px; padding-left: 10px;">Đăng nhập</a>
    </li>
  @endif
</ul>
