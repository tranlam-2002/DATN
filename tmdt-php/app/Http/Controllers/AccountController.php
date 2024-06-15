<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
   public function index()
    {
        $user = Auth::user();
        return view('account.index', compact('user'), [
            'title'=>'Quản lý tài khoản'
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('account.edit', compact('user'), [
            'title'=>'Sửa Tài khoản'
        ]);
    }

   public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        try {
            $user->save();
            return redirect()->route('account.index')->with('success', 'Thông tin tài khoản đã được cập nhật.');
        } catch (\Exception $e) {
            Log::error('User update failed: ' . $e->getMessage());
            return redirect()->route('account.index')->with('error', 'Đã xảy ra lỗi khi cập nhật thông tin tài khoản.');
        }
    }

    public function showChangePasswordForm()
    {
        return view('account.change-password',  [
            'title'=>'Đổi Mật Khẩu'
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('account.index')->with('success', 'Mật khẩu đã được thay đổi.');
    }

    public function orders()
    {
        // Lấy user hiện tại
        $user = Auth::user();

        // Lấy danh sách đơn hàng của user hiện tại và phân trang
        $customers = Customer::where('user_id', $user->id)->paginate(10);

        return view('account.orders', compact('customers'), [
                'title'=>'Lịch Sử Đơn Hàng'
         ]);
    }

    public function show($customerId)
    {
        // Lấy thông tin khách hàng và chi tiết đơn hàng
        $customer = Customer::findOrFail($customerId);
        $carts = Cart::where('customer_id', $customer->id)
            ->with('product')
            ->get();

        return view('account.order_details', compact('customer', 'carts'), [
                'title'=>'Lịch Sử Đơn Hàng'
         ]);
    }
    public function destroy($id)
    {
        $customer = Customer::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Xóa giỏ hàng liên quan
        $customer->carts()->delete();

        // Xóa đơn hàng của khách hàng
        $customer->delete();

        return redirect()->route('account.orders')->with('success', 'Đơn hàng đã được hủy.');
    }
}