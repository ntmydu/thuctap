<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsOrder;
use App\Models\Order;
use App\Models\ReturnOrd;
use Illuminate\Http\Request;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;

class MainController extends Controller
{
    public function index()
    {
        $newOrders = Order::where('status', 'unconfirmed')->count();
        $newOrdReturn = ReturnOrd::where('status', 'unprocess')->count();
        $orders = Order::orderBy('created_at', 'DESC')->paginate(5);
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('price');
        $totalCustomers = Order::distinct('customer_id')->count('customer_id');
        $totalProducts = Order::sum('quantity');

        return view('admin.dashboard', [
            'title' => 'Admin CocoonVietNam',
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'totalCustomers' => $totalCustomers,
            'totalProducts' => $totalProducts,
            'orders' => $orders,
            'newOrders' => $newOrders,
            'newOrdReturn' => $newOrdReturn
        ]);
    }



    public function dashboard(Request $request)
    {
        $newOrders = Order::where('status', 'unconfirmed')->count();
        $newOrdReturn = ReturnOrd::where('status', 'unprocess')->count();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $today = Carbon::today()->format('Y-m-d');


        $orders = Order::orderBy('created_at', 'DESC')->paginate(5);

        // Lọc theo khoảng thời gian
        if ($startDate && $endDate) {
            $endDate = Carbon::parse($endDate)->endOfDay();
            $orderstat = Order::whereBetween('created_at', [$startDate, $endDate])->get();
        } else {
            $orderstat = Order::whereDate('created_at', $today)->get();
        }

        // Tính toán thống kê
        $totalOrders = $orderstat->count();

        $totalRevenue = $orderstat->sum('price');
        $totalCustomers = $orderstat->unique('customer_id')->count();
        $totalProducts = $orderstat->sum('quantity');

        // Lưu thống kê vào cơ sở dữ liệu
        Statistic::updateOrCreate(
            ['date' => $today], // Điều kiện để kiểm tra thống kê đã tồn tại
            [
                'total_orders' => $totalOrders,
                'total_revenue' => $totalRevenue,
                'total_customers' => $totalCustomers,
                'total_products' => $totalProducts,
            ]
        );

        // Lấy danh sách đơn hàng

        return view('admin.dashboard', [
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'totalCustomers' => $totalCustomers,
            'totalProducts' => $totalProducts,
            'newOrders' => $newOrders,
            'newOrdReturn' => $newOrdReturn
        ]);
    }
}