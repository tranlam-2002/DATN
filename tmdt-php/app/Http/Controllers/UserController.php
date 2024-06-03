<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // đăng nhập
    public function login(){
        return view('fe.login', [
            'title'=>'Đăng Nhập'
        ]);
    }
    public function postLogin(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            
            return redirect()->route('home')->with('success', 'Đăng nhập thành công');
        } else {
            return redirect()->back()
                             ->with('error', 'Đăng nhập thất bại. Vui lòng kiểm tra lại email hoặc mật khẩu.')
                             ->withInput();
        }
    }
    
    // đăng xuất
    public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home'); // Redirect to home or any other page
        }

    // đăng ký
    public function register(){
        return view('fe.register', [
            'title'=>'Đăng Ký'
        ]);
    }
    public function postRegister(Request $request){
     $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

         try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Auto-login the user after registration
            auth()->login($user);

            // Add success message to session
            return redirect()->route('login')->with('success', 'Đăng ký thành công!');
        } catch (Exception $err) {
            // Log the error or handle it as needed
            Log::error('User Registration Error: ' . $err->getMessage());

            // Redirect back with an error message
            return redirect()->back()
                             ->with('error', 'Đã xảy ra lỗi trong quá trình đăng ký. Vui lòng thử lại.')
                             ->withInput();
        }
    }

    // Quên mật khẩu
     public function forgot_password(){
        return view('fe.forgot_password', [
            'title'=>'Đổi Mật Khẩu'
        ]);
    }
    public function postForgot_password(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Không tìm thấy người dùng với địa chỉ email này.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Gửi email thông báo đổi mật khẩu thành công
        Mail::send('fe.email', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Mật khẩu của bạn đã được đổi thành công');
        });

        return redirect()->route('login')->with('success', 'Mật khẩu đã được đổi thành công. Vui lòng kiểm tra email của bạn.');
    }
}