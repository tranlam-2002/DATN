<?php


namespace App\Http\Services;


use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class CartService
{
    public function create($request)
    {
        try {
            $qty = (int)$request->input('num_product');
            $product_id = (int)$request->input('product_id');
            
            // \Log::info('Số lượng sản phẩm: ' . $qty);
            // \Log::info('ID sản phẩm: ' . $product_id);
            
            if ($qty <= 0 || $product_id <= 0 ) {
                // \Log::error('Số lượng hoặc Sản phẩm không chính xác');
                Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
                return redirect()->back();
            }

            $carts = Session::get('carts');
            if (is_null($carts)) {
                Session::put('carts', [
                    $product_id => $qty
                ]);
                return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
            }

            $exists = Arr::exists($carts, $product_id);
            if ($exists) {
                $carts[$product_id] = $carts[$product_id] + $qty;
                Session::put('carts', $carts);
                return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công');
            }

            $carts[$product_id] = $qty;
            Session::put('carts', $carts);
            return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
            
        } catch (\Exception $e) {
            \Log::error('Lỗi khi thêm sản phẩm vào giỏ hàng: ' . $e->getMessage());
            Session::flash('error', 'Lỗi khi thêm sản phẩm vào giỏ hàng');
            return redirect()->back();
        }
    }

    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) return [];

        $productId = array_keys($carts);
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
    }
        public function update($request)
    {
        Session::put('carts', $request->input('num_product'));

        return true;
    }
        public function remove($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts', $carts);
        return true;
    }
    // Phần đặt hàng
    public function addCart($request){
        try {
            DB::beginTransaction();
            
            $carts = Session::get('carts');
            if (is_null($carts)) return false;
            
            // Tổng số tiền đã tính trong view
            $total = $request->input('total');

            // Kiểm tra số tiền giao dịch hợp lệ
            if ($total < 5000 || $total >= 1000000000) {
                throw new \Exception('Số tiền giao dịch không hợp lệ. Số tiền hợp lệ từ 5,000 đến dưới 1 tỷ đồng.');
            }
            
            // Lưu thông tin khách hàng và lấy ID tự động tăng
            $customer = Customer::create([
                'user_id' => Auth::id(),
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'content' => $request->input('content'),
                'payment_method' => $request->input('payment_method')
            ]);

            // Sử dụng ID tự động tăng làm mã đơn hàng
            $vnp_TxnRef = $customer->id;

            $this->infoProductCart($carts, $customer->id);
            DB::commit();

            /// Chuyển hướng đến VNPay nếu chọn phương thức thanh toán online bằng VNPay
            if ($request->input('payment_method') == 'vnpay') {
                try {
                    // Tạo URL VNPay và chuyển hướng
                    $vnpayUrl = $this->VNPayUrl($request, $customer);

                    // Ghi log URL của VNPay
                    \Log::info('VNPay URL: ' . $vnpayUrl);
                    
                    return redirect($vnpayUrl);
                } catch (\Exception $err) {
                    \Log::error('Lỗi khi tạo URL VNPay: ' . $err->getMessage());
                    Session::flash('error', 'Lỗi khi tạo URL thanh toán VNPay, vui lòng thử lại sau.');
                    return redirect()->back();
                }
            }
            
            Session::flash('success', 'Đặt Hàng Thành Công');

            #Queue
            //SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));
            SendMail::dispatch($customer, $carts)->delay(now()->addSeconds(2));
            Session::forget('carts');  
        }
        catch(\Exception $err){
            DB::rollBack();
            \Log::error('Đặt hàng lỗi: ' . $err->getMessage());
            Session::flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
            return false;
        }
        return true;
    }

    // Phần thanh toán 
    public function VNPayUrl(Request $request, $customer)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data=$request->all();
        \Log::info('VNPay request data: ', $data);
        $vnp_Url = env('VNPAY_URL'); // URL của VNPay
        $vnp_TmnCode = env('VNPAY_TMNCODE');//Mã website tại VNPAY 
        $vnp_HashSecret = env('VNPAY_HASHSECRET'); //Chuỗi bí mật
        $vnp_Returnurl = route('vnpay.return'); // URL trả về sau khi thanh toán
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes',strtotime($startTime)));
        
        $vnp_TxnRef = $customer->id; // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $data['total'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
    }

    protected function infoProductCart($carts, $customer_id)
    {
        $productId = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'pty'   => $carts[$product->id],
                'price' => $product->price_sale != 0 ? $product->price_sale : $product->price
            ];
        }

        return Cart::insert($data);
    }
    public function getCustomer(){
        return Customer::orderByDesc('id')->paginate(15);
    }
    
    public function getProductForCart($customer)
    {
        return $customer->carts()->with(['product' => function ($query) {
            $query->select('id', 'name', 'thumb');
        }])->get();
    }
    public function destroy($request)
    {
        $customer = Customer::where('id', $request->input('id'))->first();
        if ($customer) {
            $customer->delete();
            return true;
        }

        return false;
    }
}  