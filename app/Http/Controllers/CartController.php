<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Slide;
use App\Models\Upload;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
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
        return view('cart.list', [
            'menus' => $menus,
            'products' => $products,
            'slides' => $slides,
            'totalAmount' => $totalAmount
        ]);
    }
    public function create(Request $request)
    {
        $product_id = $request->product_hidden;
        $quantity = $request->qty;
        $product = Product::where('id', $product_id)->first();
        if (!$product_id) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }


        $cart = session()->get('cart', []);
        if ($product->price_sale == 0) {
            $price = $product->price;
        } else {
            $price = $product->price_sale;
        }
        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            $cart[$product_id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $price,
                'quantity' => $quantity,
                'image' => $product->image[0]->image_name
            ];
        }
        session()->put('cart', $cart);

        //--
        $totalQuantity = 0;
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }

        foreach ($cart as $item) {
            $totalPrice += $item['price'];
        }

        toastify()->success('Thêm vào giỏ hàng thành công!', [
            'duration' => 5000,
            'gravity' => 'top',
            'position' => 'right'
        ]);

        return redirect()->back();
    }
    public function updateQuantity(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $product = Product::find($id);

            // Kiểm tra số lượng kho
            $requestedQuantity = $request->input('quantity');
            if ($requestedQuantity > $product->stock) {
                toastify()->error('Số lượng vượt quá số lượng kho!', [
                    'duration' => 5000,
                    'gravity' => 'top',
                    'position' => 'right'
                ]);
                return redirect()->back();
            }

            $cart[$id]['quantity'] = $requestedQuantity;
            session()->put('cart', $cart);

            toastify()->success('Cập nhật số lượng thành công!', [
                'duration' => 5000,
                'gravity' => 'top',
                'position' => 'right'
            ]);

            return redirect()->back();
        }
    }

    public function minusQuantity($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] - 1;
            session()->put('cart', $cart);

            toastify()->success('Sản phẩm giảm 1!', [
                'duration' => 5000,
                'gravity' => 'top',
                'position' => 'right'
            ]);
            return redirect()->back()->with('success', 'Số lượng sản phẩm đã được cập nhật');
        }
    }

    public function plusQuantity($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $product = Product::find($id);
            if ($cart[$id]['quantity'] < $product->stock) {
                $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
                toastify()->success('Sản phẩm thêm 1!', [
                    'duration' => 5000,
                    'gravity' => 'top',
                    'position' => 'right'
                ]);
                session()->put('cart', $cart);
            } else {
                toastify()->error('Số lượng vượt quá số lượng kho!', [
                    'duration' => 5000,
                    'gravity' => 'top',
                    'position' => 'right'
                ]);
            }
        }



        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        $cart = session()->get('cart', []);


        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
        }
    }
}