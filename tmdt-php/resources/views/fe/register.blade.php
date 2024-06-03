@extends('welcome')
@section('content')

<div class="container"
    style="background-color: #fff; margin-top: 50px; margin-bottom: 80px; padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); display: flex; justify-content: center; align-items: center;">
    <div class="form-container">

        @include('home.alert')

        <form action="{{ route('register') }}" id="registerForm" class="form custom-form" method="POST">
            @csrf
            <h2>Đăng Ký</h2>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" id="registerUsername" class="custom-input" placeholder="Tên người dùng" name="name"
                    value="{{ old('name') }}" required>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="registerEmail" class="custom-input" placeholder="Email" name="email"
                    value="{{ old('email') }}" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="registerPassword" class="custom-input" placeholder="Mật khẩu" name="password"
                    required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="confirmPassword" class="custom-input" placeholder="Xác nhận mật khẩu"
                    name="password_confirmation" required>
            </div>
            <button type="submit" class="custom-button">Đăng Ký</button>
            <p class="toggle">Đã có tài khoản? <a href="{{ route('login') }}" id="showLogin">Đăng nhập</a></p>
        </form>
    </div>
</div>
@endsection