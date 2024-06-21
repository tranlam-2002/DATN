<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ContactMessage;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request){
        // Lấy năm từ request hoặc sử dụng năm hiện tại nếu không có
        $year = $request->input('year', Carbon::now()->year);
        
        $newCustomersCount = Customer::where('status', 'pending')->count();
        $productsCount = Product::count();
        $usersCount = User::count();
        $contactsCount = ContactMessage::count();
        
        // Doanh thu hàng tháng trong năm hiện tại
        $monthlyRevenueData = Cart::join('customers', 'carts.customer_id', '=', 'customers.id')
        // dựa vào dữ liệu đã hoàn thành và chưa hoàn thành để tính doanh thu tháng 
            ->select(
                DB::raw('SUM(CASE WHEN customers.delivered = 1 THEN carts.price ELSE 0 END) as completed_revenue'),
                DB::raw('SUM(CASE WHEN customers.delivered = 0 THEN carts.price ELSE 0 END) as pending_revenue'),
                DB::raw('MONTH(customers.created_at) as month')
            )
            // dựa vào tháng trong customer
            ->whereYear('customers.created_at', '=', $year)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Tạo mảng với các tháng từ 1 đến 12 và gán giá trị doanh thu
        $monthlyCompletedRevenue = array_fill(1, 12, 0);
        $monthlyPendingRevenue = array_fill(1, 12, 0);

        foreach ($monthlyRevenueData as $data) {
            $monthlyCompletedRevenue[$data->month] = $data->completed_revenue;
            $monthlyPendingRevenue[$data->month] = $data->pending_revenue;
        }

        // In dữ liệu ra log để kiểm tra
        \Log::info('Monthly Completed Revenue:', $monthlyCompletedRevenue);
        \Log::info('Monthly Pending Revenue:', $monthlyPendingRevenue);

        return view('admin.home', compact('newCustomersCount', 'productsCount', 'usersCount', 'contactsCount', 'monthlyCompletedRevenue', 'monthlyPendingRevenue', 'year'), [
            'title' => 'Trang Quản Trị Admin'
        ]);
    }
}