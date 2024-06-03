@extends('welcome')
@section('content')

<div class="container" style="background-color: #fff; margin-top: 50px; margin-bottom: 80px; padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); display: flex; justify-content: center; align-items: center;">
    <div class="form-container">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('postForgot_password') }}" id="resetPasswordForm" class="form custom-form" method="POST">
            @csrf
            <h2>Đổi Mật Khẩu</h2>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" class="custom-input" placeholder="Email" name="email" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="newPassword" class="custom-input" placeholder="Mật khẩu mới" name="password" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="confirmNewPassword" class="custom-input" placeholder="Xác nhận mật khẩu mới" name="password_confirmation" required>
            </div>
            <button type="submit" class="custom-button">Đổi mật khẩu</button>
        </form>
    </div>
</div>
@endsection
