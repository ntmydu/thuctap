<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Menu;
use App\Models\Upload;
use App\Models\Ratting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductFeController extends Controller
{
    public function index($id)
    {
        $product = Product::where('id', $id)->first();
        $menus = Menu::orderBy('name', 'ASC')->select('id', 'name')->get();

        $images = Upload::where('product_id', $product->id)->get();
        $ratings = Ratting::where('product_id', $product->id)->get();
        $rat = Ratting::where('product_id', $product->id)->avg('rating');
        $rating = round($rat);

        return view('fontend.product.detail', [
            'product' => $product,
            'menus' => $menus,
            'images' => $images,
            'rating' => $rating,
            'ratings' => $ratings
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
    public function showReview($id)
    {
        $product = Product::find($id);
        $menus = Menu::orderBy('name', 'ASC')->select('id', 'name')->get();
        $rating = Ratting::where('product_id', $product->id)->avg('rating');
        $rating = round($rating);

        return view(
            'fontend.product.review',
            [
                'product' => $product,
                'menus' => $menus,
                'rating' => $rating
            ]
        );
    }
    public function addReview(Request $request)
    {

        $request->validate([
            'comment' => 'nullable|string|max:500',
        ]);
        $randomId = Str::random(10);
        $data = $request->all();
        $rating = Ratting::create([
            'id' => $randomId,
            'user_id' => Auth::user()->id,
            'product_id' => $request->products_hidden,
            'rating' => $request->rating,
            'comment' => $request->comment,

        ]);

        toastify()->success('Cảm quý khách đã đánh giá.', [
            'duration' => 5000,
        ]);
        return redirect()->back();
    }
}