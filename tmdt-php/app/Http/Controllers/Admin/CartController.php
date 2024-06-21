<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use App\Models\Customer;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartService $cart){
        $this->cart = $cart;
    }
    public function index(){
        return view('admin.carts.customer',[
           'title' => 'Danh Sách Đơn Đặt Hàng',
           'customers'=>$this->cart->getCustomer() 
        ]);
    }
    public function show(Customer $customer){
        
        
        $carts = $this->cart->getProductForCart($customer);
        
        return view('admin.carts.detail',[
           'title'=>'Chi tiết đơn hàng: ' .$customer->name,
           'customer' => $customer,
           'carts'=>$carts
        ]);
    }
    public function destroy(Request $request){
        $result = $this->cart->destroy($request);
        if($result){
            return response()->json([
                'error'=> false,
                'message'=> 'Xóa thành công đơn hàng'
            ]);
        }
        return response()->json(['error' => true]);
    }
    // Trạng thái đơn hàng
   public function status()
    {
        // Lấy danh sách customers với các cart, sắp xếp theo ngày tạo mới nhất trước
        $customers = Customer::with('carts')->orderBy('created_at', 'desc')->paginate(10);

        // Trả về view với danh sách customers đã được sắp xếp và phân trang
        return view('admin.carts.index', compact('customers'), [
            'title' => 'Xử Lý Đơn Hàng'
        ]);
    }


    public function updateStatus(Request $request, $customerId)
    {
        // tìm đơn hàng theo ID
        $customer = Customer::findOrFail($customerId);
        
        // xác thực dữ liệu
        $request->validate([
            'status' => 'required|string|in:pending,approved,shipped',
        ]);
        
        // cập nhật đơn hàng
        $customer->status = $request->status;
        $customer->save();

        return redirect()->route('admin.carts.index')->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }
}