@extends('welcome')
@section('content')

<div class="container"
    style="background-color: #fff; margin-top: 50px; margin-bottom: 80px; padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); display: flex; justify-content: center; align-items: center;">
    <div class="form-container">        
         <!-- Hiển thị thông báo lỗi và thành công -->
            @include('home.alert')
        <form action="{{ route('login') }}" id="loginForm" class="form custom-form" method="POST">
            @csrf
            <h2>Đăng Nhập</h2>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="loginEmail" class="custom-input" placeholder="Email" name="email" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" id="loginPassword" class="custom-input" placeholder="Mật khẩu" name="password" required>
            </div>
            <div class="input-group" style="display: block; text-align: right;">
                <a href="{{ route('forgot_password') }}" class="forgot-password-link">Quên mật khẩu?</a>
            </div>
            <button type="submit" class="custom-button">Đăng Nhập</button>
            
            <p class="toggle">Chưa có tài khoản? <a href="{{ route('register') }}" id="showRegister">Đăng ký</a></p>
        </form>
    </div>
</div>

@endsection
