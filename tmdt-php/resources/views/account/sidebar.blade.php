<div class="sidebar-sticky">
    <div class="account-heading">
        <p>Quản Lý Thông Tin</p>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('account.index')) active @endif" href="{{ route('account.index') }}">
                <i class="fas fa-user"></i>
                <span>Thông tin tài khoản</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('account.edit')) active @endif" href="{{ route('account.edit') }}">
                <i class="fas fa-edit"></i>
                <span>Chỉnh sửa tài khoản</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('account.change-password')) active @endif" href="{{ route('account.change-password') }}">
                <i class="fas fa-key"></i>
                <span>Đổi mật khẩu</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('account.orders')) active @endif" href="{{ route('account.orders') }}">
                <i class="zmdi zmdi-shopping-cart"></i>
                <span>Lịch sử đơn hàng</span>
            </a>
        </li>
    </ul>
</div>
