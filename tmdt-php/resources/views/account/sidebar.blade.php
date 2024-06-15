<div class="sidebar-sticky">
    <div class="account-heading">
        <p>Quản Lý Thông Tin</p>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('account.index')) active @endif" href="{{ route('account.index') }}">
                Thông tin tài khoản
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('account.edit')) active @endif" href="{{ route('account.edit') }}">
                Chỉnh sửa tài khoản
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('account.change-password')) active @endif" href="{{ route('account.change-password') }}">
                Đổi mật khẩu
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(request()->routeIs('account.orders')) active @endif" href="{{ route('account.orders') }}">
                Lịch sử đơn hàng
            </a>
        </li>
    </ul>
</div>
