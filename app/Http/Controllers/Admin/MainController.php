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

    public function weekStatistics()
    {

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek()->endOfDay();
        $weeklyOrders = Order::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();
        $orders = Order::orderBy('created_at', 'DESC')->paginate(5);
        $newOrders = Order::where('status', 'unconfirmed')->count();
        $newOrdReturn = ReturnOrd::where('status', 'unprocess')->count();
        $today = Carbon::today()->format('Y-m-d');

        $totalOrders = $weeklyOrders->count();
        $totalRevenue = $weeklyOrders->sum('price');
        $totalCustomers = $weeklyOrders->unique('customer_id')->count();
        $totalProducts = $weeklyOrders->sum('quantity');

        Statistic::updateOrCreate(
            ['date' => $today], // Điều kiện để kiểm tra thống kê đã tồn tại
            [
                'total_orders' => $totalOrders,
                'total_revenue' => $totalRevenue,
                'total_customers' => $totalCustomers,
                'total_products' => $totalProducts,
            ]
        );
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
    public function todayStatistics()
    {
        $today = Carbon::today()->format('Y-m-d');
        $todayOrders = Order::whereDate('created_at', $today)->get();
        $orders = Order::orderBy('created_at', 'DESC')->paginate(5);
        $newOrders = Order::where('status', 'unconfirmed')->count();
        $newOrdReturn = ReturnOrd::where('status', 'unprocess')->count();

        $totalOrders = $todayOrders->count();
        $totalRevenue = $todayOrders->sum('price');
        $totalCustomers = $todayOrders->unique('customer_id')->count();
        $totalProducts = $todayOrders->sum('quantity');

        Statistic::updateOrCreate(
            ['date' => $today], // Điều kiện để kiểm tra thống kê đã tồn tại
            [
                'total_orders' => $totalOrders,
                'total_revenue' => $totalRevenue,
                'total_customers' => $totalCustomers,
                'total_products' => $totalProducts,
            ]
        );
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
    public function monthStatistics()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth()->endOfDay();
        $monthlyOrders = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();
        $orders = Order::orderBy('created_at', 'DESC')->paginate(5);
        $newOrders = Order::where('status', 'unconfirmed')->count();
        $newOrdReturn = ReturnOrd::where('status', 'unprocess')->count();
        $today = Carbon::today()->format('Y-m-d');

        $totalOrders = $monthlyOrders->count();
        $totalRevenue = $monthlyOrders->sum('price');
        $totalCustomers = $monthlyOrders->unique('customer_id')->count();
        $totalProducts = $monthlyOrders->sum('quantity');

        Statistic::updateOrCreate(
            ['date' => $today], // Điều kiện để kiểm tra thống kê đã tồn tại
            [
                'total_orders' => $totalOrders,
                'total_revenue' => $totalRevenue,
                'total_customers' => $totalCustomers,
                'total_products' => $totalProducts,
            ]
        );
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
    public function yearStatistics()
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear()->endOfDay();
        $yearlyOrders = Order::whereBetween('created_at', [$startOfYear, $endOfYear])->get();
        $orders = Order::orderBy('created_at', 'DESC')->paginate(5);
        $newOrders = Order::where('status', 'unconfirmed')->count();
        $newOrdReturn = ReturnOrd::where('status', 'unprocess')->count();
        $today = Carbon::today()->format('Y-m-d');

        $totalOrders = $yearlyOrders->count();
        $totalRevenue = $yearlyOrders->sum('price');
        $totalCustomers = $yearlyOrders->unique('customer_id')->count();
        $totalProducts = $yearlyOrders->sum('quantity');

        Statistic::updateOrCreate(
            ['date' => $today], // Điều kiện để kiểm tra thống kê đã tồn tại
            [
                'total_orders' => $totalOrders,
                'total_revenue' => $totalRevenue,
                'total_customers' => $totalCustomers,
                'total_products' => $totalProducts,
            ]
        );
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