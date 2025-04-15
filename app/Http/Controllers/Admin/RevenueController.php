<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class RevenueController extends Controller
{

    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Order::query();
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }


        $totalRevenue = $query->where('status', 'completed')->sum('total');


        $totalOrders = $query->count();


        $totalCustomers = User::where('role', 'customer')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();


        $totalProducts = Product::whereBetween('created_at', [$startDate, $endDate])->count();


        $recentOrders = $query->latest()->take(5)->get();

        return view('admin.dashboard', [
            'title' => 'Admin CocoonVietNam',
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers,
            'totalProducts' => $totalProducts,
            'recentOrders' => $recentOrders,
        ]);
    }
}
