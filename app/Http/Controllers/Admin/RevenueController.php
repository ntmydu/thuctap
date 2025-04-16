<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class RevenueController extends Controller
{
    public function index()
    {
        // Lấy ngày hiện tại
        $today = Carbon::today();

        // Lọc đơn hàng trong ngày hiện tại
        $query = Order::whereDate('created_at', $today);

        // Tính tổng doanh thu từ các đơn hàng đã hoàn thành trong ngày
        $totalRevenue = $query->where('status', 'completed')->sum('total');

        // Tính tổng số đơn hàng trong ngày
        $totalOrders = $query->count();

        // Tính tổng số khách hàng đăng ký trong ngày
        $totalCustomers = User::where('role', 'customer')
            ->whereDate('created_at', $today)
            ->count();

        // Tính tổng số sản phẩm được thêm trong ngày
        $totalProducts = Product::whereDate('created_at', $today)->count();

        // Lấy danh sách đơn hàng mới nhất trong ngày
        $recentOrders = $query->latest()->take(5)->get();

        return view('admin.dashboard', [
            'title' => 'Thống kê trong ngày',
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers,
            'totalProducts' => $totalProducts,
            'recentOrders' => $recentOrders,
        ]);
    }
}
