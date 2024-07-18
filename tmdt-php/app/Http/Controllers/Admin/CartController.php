<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use App\Models\Customer;
use Illuminate\Http\Request;
use PDF;

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
    //Tìm Kiếm Đơn Hàng
    public function search(Request $request)
    {
        $search = $request->query('search');

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

        // Tìm kiếm khách hàng theo tên, email, id hoặc trạng thái
        $customers = Customer::where(function ($query) use ($search, $statusValue) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");

            if ($statusValue) {
                $query->orWhere('status', $statusValue);
            }
        })
        ->orderByDesc('id')
        ->paginate(10);

        return view('admin.carts.customer', compact('customers'),[
            'title' => 'Danh Sách Đơn Đặt Hàng'
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
    public function exportPDF($id){
        $customer = Customer::findOrFail($id);
        $carts = $customer->carts; // Giả sử có relationship đã được định nghĩa trong model

        $statusTexts = [
            'pending' => 'Chờ duyệt',
            'approved' => 'Đã duyệt',
            'shipped' => 'Đã giao',
        ];

        $paymentMethods = [
            'cash_on_delivery' => 'Thanh toán khi nhận hàng',
            'payment_at_store' => 'Thanh toán tại cửa hàng',
            'vnpay' => 'Thanh toán bằng VNPAY',
        ];
        
        // Load view và render PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.carts.pdf', compact('customer', 'carts', 'statusTexts', 'paymentMethods'));

        // Tùy chỉnh tên file và xuất PDF để tải về
        return $pdf->download($customer->name . $customer->id . '.pdf');
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
        // Lấy danh sách customers với các cart, sắp xếp theo mã đơn hàng mới nhất
        $customers = Customer::with('carts')->orderByDesc('id')->paginate(10);

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
    //Tìm kiếm XLDH
    public function searchXLDH(Request $request)
    {
        $search = $request->query('search');

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

        // Tìm kiếm khách hàng theo tên, email, id hoặc trạng thái
        $customers = Customer::where(function ($query) use ($search, $statusValue) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%");

            if ($statusValue) {
                $query->orWhere('status', $statusValue);
            }
        })
        ->orderByDesc('id')
        ->paginate(10);

        return view('admin.carts.index', compact('customers'), [
            'title' => 'Xử Lý Đơn Hàng'
        ]);
    }

}