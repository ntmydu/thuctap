<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Upload;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::all();
        // $slides = Slide::orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        $slides =  Slide::orderBy('id', 'DESC')->get();
        $product = Product::all()->take(4);
        $images = Upload::all();
        return view('fontend.home', [
            'slides' => $slides,
            'menus' => $menus,
            'products' => $product,
            'images' => $images
        ]);
    }
    public function search(Request $request)
    {

        $keywords = $request->input('searchInput', '');
        $menus = Menu::all();
        $images = Upload::all();
        $search_product = Product::where('name', 'like', '%' . trim($keywords) . '%')->get();

        return view('fontend.search', [
            'menus' => $menus,
            'search_product' => $search_product,
            'images' => $images
        ]);
    }
}