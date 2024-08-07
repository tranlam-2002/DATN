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

    public function orders(Request $request)
    {
        // Lấy user hiện tại
        $user = Auth::user();
        
         // Nhận từ khóa tìm kiếm
        $search = $request->query('search');
        
        // Trạng thái đơn hàng
        $statusTexts = [
            'Chờ duyệt' => 'pending',
            'Đã duyệt' => 'approved',
            'Giao hàng' => 'shipped',
        ];
        
        // Tìm giá trị trạng thái nếu từ khóa khớp
        $statusValue = null;
        foreach ($statusTexts as $key => $value) {
            if (stripos($key, $search) !== false) {
                $statusValue = $value;
                break;
            }
        }
        
        // Lấy danh sách đơn hàng của user hiện tại và phân trang
        $customers = Customer::where('user_id', $user->id)
            ->when($search, function ($query) use ($search, $statusValue) {
                return $query->where(function ($query) use ($search, $statusValue) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('id', 'like', "%{$search}%");
                    if ($statusValue) {
                        $query->orWhere('status', $statusValue);
                    }
                });
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('account.orders', compact('customers'), [
            'title'=>'Lịch Sử Đơn Hàng'
        ]);
    }

    public function show(Request $request, $customerId)
    {
        // Lấy thông tin khách hàng và chi tiết đơn hàng
        $customer = Customer::findOrFail($customerId);
        $carts = Cart::where('customer_id', $customer->id)
            ->with('product')
            ->get();

        return view('account.order_details', compact('customer', 'carts'), [
            'title' => 'Chi Tiết Đơn Hàng'
        ]);
    }

    public function showPut($customerId)
    {
        $customer = Customer::findOrFail($customerId);

        // Kiểm tra nếu đơn hàng chưa được nhận và đang ở trạng thái 'shipped'
        if ($customer->status === 'shipped' && !$customer->delivered) {
            $customer->delivered = true;
            $customer->save();

            return redirect()->route('orders.show', $customerId)->with('success', 'Đơn hàng đã nhận thành công.');
        }

        // Nếu không phải trường hợp trên, redirect về trang chi tiết đơn hàng với thông báo lỗi
        return redirect()->route('account.order_details', $customerId)->with('error', 'Không thể đánh dấu đơn hàng này là đã nhận được.');
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