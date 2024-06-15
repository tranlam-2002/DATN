@extends('account.layouts')

@section('account-content')
<div class="main-content-wrapper">
    <h2>Đổi Mật Khẩu</h2>

    @include('alert')

    <form action="{{ route('account.change-password') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="current_password">Mật Khẩu Hiện Tại</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>

        <div class="form-group">
            <label for="new_password">Mật Khẩu Mới</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Xác Nhận Mật Khẩu Mới</label>
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Đổi Mật Khẩu</button>
    </form>
</div>
@endsection
