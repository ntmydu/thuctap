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
        $rating = Ratting::where('product_id', $product->id)->avg('rating');
        $rating = round($rating);

        return view('fontend.product.detail', [
            'product' => $product,
            'menus' => $menus,
            'images' => $images,
            'rating' => $rating
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
    public function addRating(Request $request)
    {
        $data = $request->all();
        $rating = Ratting::create([]);
    }
}
