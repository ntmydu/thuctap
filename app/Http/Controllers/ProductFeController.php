<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Upload;
use App\Models\Ratting;
use Illuminate\Support\Facades\Auth;

class ProductFeController extends Controller
{
    public function index($id)
    {
        $product = Product::where('id', $id)->first();
        $menus = Menu::orderBy('name', 'ASC')->select('id', 'name')->get();

        $images = Upload::where('product_id', $product->id)->get();
        return view('fontend.product.detail', [
            'product' => $product,
            'menus' => $menus,
            'images' => $images
        ]);
    }
    public function show($id)
    {
        $menus = Menu::all();
        $menu = Menu::find($id);
        $products = Product::where('menu_id', $id)->get();
        $images = Upload::all();
        return view('fontend.product.list', [
            'products' => $products,
            'menus' => $menus,
            'menu' =>  $menu,
            'images' => $images
        ]);
    }
    // public function addReview(Request $request, $id)
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('view.login')->with('error', 'Bạn cần đăng nhập để sử dụng mã giảm giá.');
    //     }
    //     // $product = Product::where('id', $id)->first();
    //     // $menus = Menu::orderBy('name', 'ASC')->select('id', 'name')->get();

    //     // $images = Upload::where('product_id', $product->id)->get();
    //     $product_id = $request->product_hidden;
    //     $review = Ratting::created([
    //         'product_id' => $request->product_id,
    //         'user_id' => Auth::id(), // Lấy ID người dùng đang đăng nhập
    //         'rating' => $request->rating,
    //         'comment' => $request->comment,
    //     ]);
    //     $rating = Ratting::where('product_id', $product_id)->svg('rating');
    //     $rating = round('rating');
    //     return $rating;
    //     return redirect()->back();
    // }
}
