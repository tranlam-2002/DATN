<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function index(){
        return view('admin.users.login',[
           'title' => 'Đăng nhập hệ thống' 
        ]);
    }
   public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email:filter',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Tiếp tục xử lý đăng nhập nếu dữ liệu hợp lệ
            if (Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ],
            $request->input('remember')
        ))
        {
           return redirect()->route('admin')->with('success', 'Đăng nhập thành công!');
        }
            return redirect()->back()->with('error', 'Tên người dùng hoặc mật khẩu không đúng.');
        }

}