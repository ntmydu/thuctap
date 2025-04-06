<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Upload;
use App\Models\Payment;

use App\Models\ProductsOrder;

class OrderAdController extends Controller
{
    public function index()
    {

        $orders = Order::orderBy('created_at', 'DESC')->paginate(15);
        $products = Product::get();
        return view('admin.order.list', [

            'orders' => $orders,
            'products' => $products
        ]);
    }
    public function view($id)
    {

        $order = Order::find($id);


        if ($order) {

            $products = ProductsOrder::where('order_id', $order->id)->get();

            return view('admin.order.detail', [
                'order' => $order,

                'products' => $products
            ]);
        }
    }
    public function search(Request $request)
    {

        $keywords = $request->input('searchInput', '');

        $order = Order::all();

        $search_order = Order::where('id', 'like', '%' . trim($keywords) . '%')->get();


        return view('admin.order.search', [
            'order' => $order,
            'search_order' => $search_order,

        ]);
    }
    public function update(Request $request, $id)
    {

        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();


        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật!');
    }
    // public function printOrder($id)
    // {
    //     $order = Order::find($id);


    //     if ($order) {
    //         $customer = Customer::find($order->customer_id);
    //         $products = ProductsOrder::where('order_id', $order->id)->get();
    //     }
    //     $pdf = PDF::loadView('admin.order.detail', [
    //         'order' => $order,
    //         'customer' => $customer,
    //         'products' => $products
    //     ]);
    //     return $pdf->download('don_hang_' . $order->id . '.pdf');
    // }    
}