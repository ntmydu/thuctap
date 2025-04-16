<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Slide;
use App\Models\Upload;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Discount;
use App\Models\ReturnOrd;
use App\Models\ProductsOrder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Illuminate\Container\Attributes\DB;
use Nette\Utils\Random;

class OrderController extends Controller
{
    public function index(Request $request)
    {


        $menus = Menu::all();
        // $slides = Slide::orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        $slides =  Slide::orderBy('id', 'DESC')->get();
        $products = Product::get();
        $carts = session()->get('cart', []);

        $totalAmount = 0;

        // Tính tổng tiền cho giỏ hàng
        if (!is_null($carts)) {
            foreach ($carts as $cartItem) {
                $totalAmount += $cartItem['price'] * $cartItem['quantity'];
            }
        }

        return view('fontend.checkout.order', [
            'menus' => $menus,
            'products' => $products,
            'slides' => $slides,
            'totalAmount' => $totalAmount,
        ]);
    }
    public function showConfirm(Request $request)
    {
        $menus = Menu::all();
        $order = session()->get('order', []);
        $randomId = Str::random(10);
        $orderData = [
            'id' => $randomId,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'note' => $request->input('note')
        ];
        session()->put('order', $orderData);


        // Chuyển hướng đến trang xác nhận
        return view('fontend.checkout.confirm', [
            'menus' => $menus,
            'order' => $order
        ]);
    }
    public function applydiscount(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('view.login');
        }
        $code = $request->discount_code;

        $discount = Discount::where('code', $code)->first();

        if (!$discount) {
            return redirect()->back();
        }

        $carts = session()->get('cart', []);
        $totalAmount = 0;

        // Tính tổng tiền cho giỏ hàng
        if (!is_null($carts)) {
            foreach ($carts as $cartItem) {
                $totalAmount += $cartItem['price'] * $cartItem['quantity'];
            }
        }
        $discountAmounts = session()->get('discountAmounts', []);
        if ($discount->formality == 'percent') {
            $discountAmount = $totalAmount * ($discount->valuation / 100);
        } else {
            $discountAmount = $discount->valuation;
        }
        $discountAmounts = [
            'discountAmount' => $discountAmount
        ];
        session()->put('discountAmounts', $discountAmounts);



        $finalPrice = max(0, $totalAmount - $discountAmount);

        $menus = Menu::all();
        // $slides = Slide::orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        $slides =  Slide::orderBy('id', 'DESC')->get();
        $products = Product::get();
        $carts = session()->get('cart', []);

        // Tính tổng tiền cho giỏ hàng
        if (!is_null($carts)) {
            foreach ($carts as $cartItem) {
                $totalAmount += $cartItem['price'] * $cartItem['quantity'];
            }
        }

        return view('cart.list', [
            'menus' => $menus,
            'products' => $products,
            'slides' => $slides,
            'totalAmount' =>  $finalPrice,
        ]);
    }
    public function reviewOrder(Request $request)
    {
        // Lấy thông tin từ session
        $order = session()->get('order', []);

        return view('fontend.checkout.confirm', [
            'order' => $order
        ]);
    }
    public function create(Request $request)
    {
        try {
            // Lấy thông tin session giỏ hàng 
            $carts = session()->get('cart', []);
            // Lấy thông tin khách hàng từ session

            $order = session()->get('order', []);
            if (is_null($carts) || is_null($order)) {
                return false;
            }

            if (Auth::check()) {
                $customerId = Auth::user()->id;
            } else {
                $customerId = $order['id'];
            }


            // Lưu thông tin khách hàng vào table Customer 
            // $newCustomer = Customer::create([
            //     'id' => $customerId,
            //     'name' => $order['name'],
            //     'email' => $order['email'],
            //     'phone' => $order['phone'],
            //     'address' => $order['address'],
            // ]);


            $randomId = Str::random(10);

            $totalPrice = 0;
            $totalQuantity = 0;
            // Thêm sản phẩm trong giỏ vào table Carts 
            foreach ($carts as $cart) {
                $totalPrice += $cart['price'];
                $totalQuantity += $cart['quantity'];
            }



            $orderNew = Order::create([
                'id' => $randomId,
                'customer_id' => $customerId,
                'name_customer' => $order['name'],
                'email' => $order['email'],
                'phone' => $order['phone'],
                'address' => 'An Giang',
                'payment_id' => $request->payment_method,
                'quantity' => $totalQuantity,
                'price' => $totalPrice,
                'note' => $order['note']
            ]);

            if ($orderNew) {
                foreach ($carts as $cart) {
                    $product = Product::find($cart['id']);

                    if ($product->stock < $cart['quantity']) {
                        return redirect()->back()->with('error', 'Số lượng yêu cầu vượt quá số lượng trong kho cho sản phẩm: ' . $product->name);
                    }

                    $randomIdProductOrder = Str::random(10);
                    $productOrderNew =  ProductsOrder::create([
                        'id' => $randomIdProductOrder,
                        'order_id' => $orderNew->id,
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'quantity' => $cart['quantity'],
                        'price' => $product->price,
                    ]);

                    $product->stock -= $cart['quantity'];
                    $product->save();
                }
            } else {
                toastify()->error('Tạo đơn hàng thất bại', [
                    'duration' => 5000,
                ]);
            }

            Payment::create([
                'payment_method' => $request->payment_method,
                'status' => 1,
            ]);


            toastify()->success('Đặt hàng thành công', [
                'duration' => 5000,
                'gravity' => 'top',
                'position' => 'right'
            ]);



            session()->forget('cart');
            session()->forget('order');

            return view('fontend.checkout.thanks');
        } catch (\Exception $err) {

            toastify()->error('Đặt hàng lỗi. Vui lòng thử lại', [
                'duration' => 5000,
                'gravity' => 'top',
                'position' => 'right'
            ]);
            return false;
        }
    }
    public function showlistOd()
    {
        if (!Auth::check()) {

            return redirect()->route('view.login')->with('error', 'Bạn cần đăng nhập khi mua hàng để xem được lịch sử mua hàng.');
        }

        $orderUnconfirmed = Order::where('customer_id', Auth::user()->id)->where('status', 'unconfirmed')->with('product')->get();

        $menus = Menu::all();
        return view('fontend.order.list', [
            'menus' => $menus,
            'orderUnconfirmed' => $orderUnconfirmed
        ]);
    }
    public function listOrdpending()
    {
        if (!Auth::check()) {

            return redirect()->route('view.login')->with('error', 'Bạn cần đăng nhập khi mua hàng để xem được lịch sử mua hàng.');
        }

        $orderPending = Order::where('customer_id', Auth::user()->id)->where('status', 'pending')->with('product')->get();

        $menus = Menu::all();
        return view('fontend.order.pending', [
            'menus' => $menus,
            'orderPending' => $orderPending
        ]);
    }
    public function listOrddelivered()
    {
        if (!Auth::check()) {
            return redirect()->route('view.login')->with('error', 'Bạn cần đăng nhập khi mua hàng để xem được lịch sử mua hàng.');
        }



        $orderDelivered = Order::where('customer_id', Auth::user()->id)->where('status', 'delivered')->with('product')->get();
        $returnOrder = ReturnOrd::get();

        $menus = Menu::all();


        return view('fontend.order.delivered', [
            'menus' => $menus,
            'orderDelivered' => $orderDelivered,
            'returnOrder' => $returnOrder
        ]);
    }
    public function listOrdCancelled()
    {
        if (!Auth::check()) {

            return redirect()->route('view.login')->with('error', 'Bạn cần đăng nhập khi mua hàng để xem được lịch sử mua hàng.');
        }

        $orderCancelled = Order::where('customer_id', Auth::user()->id)->where('status', 'cancelled')->with('product')->get();

        $menus = Menu::all();

        return view('fontend.order.cancelled', [
            'menus' => $menus,
            'orderCancelled' => $orderCancelled
        ]);
    }
    public function cancelOrd($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status !== 'unconfirmed') {
            return redirect()->back()->with('error', 'Không thể hủy đơn này.');
        }
        $order->status = 'cancelled';
        $order->save();
        return redirect()->back();
    }
    public function request($id)
    {
        $menus = Menu::orderBy('name', 'ASC')->select('id', 'name')->get();
        $order = Order::find($id);
        return view('fontend.order.return', [
            'menus' => $menus,
            'order' => $order
        ]);
    }
    public function return(Request $request)
    {

        $orderUnconfirmed = Order::where('customer_id', Auth::user()->id)->where('status', 'unconfirmed')->with('product')->get();
        $menus = Menu::orderBy('name', 'ASC')->select('id', 'name')->get();
        $randomId = Str::random(10);
        $return = ReturnOrd::create([
            'id' => $randomId,
            'order_id' => $request->order_id,
            'user_id' => Auth::user()->id,
            'reason' => $request->reason,
            'method' => $request->method,
        ]);

        return view('fontend.order.list', [
            'menus' => $menus,
            'orderUnconfirmed' => $orderUnconfirmed
        ]);
        toastify()->error('Yêu cầu đã được gửi. Vui lòng gửi thông tin qua zalo của CoCoonVietNam: 0989999888', [
            'duration' => 5000,
        ]);
    }
}