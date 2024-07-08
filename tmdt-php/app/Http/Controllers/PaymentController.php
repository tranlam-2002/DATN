<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function vnpayReturn(Request $request)
    {
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_TxnRef = $request->input('vnp_TxnRef');
        $vnp_Amount = $request->input('vnp_Amount') / 100; // chuyển đổi lại số tiền

        // \Log::info('VNPay Response Code: ' . $vnp_ResponseCode);
        // \Log::info('VNPay Transaction Reference: ' . $vnp_TxnRef);
        // \Log::info('VNPay Amount: ' . $vnp_Amount);

        if ($vnp_ResponseCode == '00') {
            // Tìm kiếm thông tin đơn hàng theo mã đơn hàng (vnp_TxnRef)
            $customer = Customer::find($vnp_TxnRef);
            // \Log::info('Customer found: ' . ($customer ? 'Yes' : 'No'));

            if ($customer) {
                $carts = Cart::where('customer_id', $customer->id)->get();
                // \Log::info('Carts found: ' . ($carts ? 'Yes' : 'No'));

                if ($carts->isNotEmpty()) {
                    // Gửi đặt hàng thông báo thành công
                    Session::flash('success', 'Đặt Hàng Thành Công');

                    // Gửi email xác nhận đơn hàng
                    SendMail::dispatch($customer, $carts)->delay(now()->addSeconds(2));

                    // Xóa giỏ hàng sau khi đặt hàng thành công
                    Session::forget('carts');
                } else {
                    Session::flash('error', 'Không tìm thấy giỏ hàng cho đơn hàng này.');
                }
            } else {
                Session::flash('error', 'Không tìm thấy thông tin đơn hàng.');
            }
        } else {
            // Thanh toán thất bại
            Session::flash('error', 'Thanh toán thất bại');
        }
        return redirect('/carts'); // Chuyển hướng về trang đơn hàng của bạn
    }
}
 