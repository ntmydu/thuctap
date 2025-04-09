<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Upload;
use Illuminate\Support\Str;
use Laravel\Prompts\Prompt;
use Illuminate\Support\Facades\File;

class ProductController extends Controller

{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('admin.product.list', compact('products'));
    }
    public function create()
    {
        $menus = Menu::orderBy('name', 'ASC')->select('id', 'name')->get();
        $upload = Upload::get();
        return view('admin.product.add', compact('menus'));
    }
    public function store(Request $request)
    {
        // if ($request->has('file_upload')) {
        //     $file = $request->file_upload;
        //     $ext = $request->file_upload->extension();
        //     $file_name = $file->getClientoriginalName();
        //     $file->move(public_path('uploads'), $file_name);
        // }
        // $request->merge(['image' => $file_name]);
        // dd($request->all());
        $request->validate([
            'images.*' => 'image | mimes:png,jpg,jpeg,webp'
        ]);
        $randomId = Str::random(10);
        $products = Product::create([
            'id' => $randomId,
            'name' => $request->name,

            'description' => $request->description,
            'content' => $request->content,
            'stock' => $request->stock,
            'menu_id' => $request->menu_id,
            'price' => $request->price,
            'price_sale' => $request->price_sale,
            'status' => $request->status,
        ]);
        $hinhanh = [];
        if ($files = $request->file('images')) {
            foreach ($files as $key => $file) {
                $duoifile = $file->getClientOriginalExtension();
                $tenfile = $key . '-' . time() . '.' . $duoifile;
                $path = "uploads/";

                $file->move($path, $tenfile);

                $tmp = [
                    'product_id' => $products->id,
                    'image_name' => $path . $tenfile
                ];

                $hinhanh[] = $tmp;
            }
            Upload::insert($hinhanh);
        }

        // if (Product::create($request->all())) 
        return redirect()->back()->with('success', 'Thêm sản phẩm thành công.');
    }
    public function update(Request $request, $id)
    {

        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($id);


        // Xác thực dữ liệu đầu vào
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'menu_id' => 'required|',
        //     'content' => 'required|string',
        //     'description' => 'required|string',
        //     'price' => 'required|numeric|min:0',
        //     'price_sale' => 'nullable|numeric|min:0|lt:price', // Ràng buộc giá giảm phải nhỏ hơn giá gốc
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'image_list' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     // Các quy tắc xác thực khác nếu cần
        // ]);

        // Cập nhật thông tin sản phẩm
        $product->name = $request->input('name');
        $product->menu_id = $request->input('menu_id');
        $product->content = $request->input('content');
        $product->stock = $request->input('stock');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->price_sale = $request->input('price_sale');
        $product->status = $request->input('status');
        $request->validate([
            'images.*' => 'image | mimes:png,jpg,jpeg,webp'
        ]);

        $hinhanh = [];
        if ($files = $request->file('images')) {

            $upload = Upload::where('product_id', $id)->get();
            foreach ($upload as $upl) {
                if (File::exists($upl->imgae_name)) {
                    File::delete(($upl->image_name));
                }
                $upl->delete();
            }
            foreach ($files as $key => $file) {
                $duoifile = $file->getClientOriginalExtension();
                $tenfile = $key . '-' . time() . '.' . $duoifile;
                $path = "uploads/";

                $file->move($path, $tenfile);

                $tmp = [
                    'product_id' => $id,
                    'image_name' => $path . $tenfile
                ];

                $hinhanh[] = $tmp;
            }
            Upload::insert($hinhanh);
        }

        $product->save();
        return redirect('/admin/product/list')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $upload = Upload::where('product_id', $id)->get();

        $menu = Menu::all();
        // Trả về view với sản phẩm
        return view('admin.product.edit', [
            'product' => $product,
            'menus' => $menu,
            'images' => $upload
        ]);
    }
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
    }
    public function search(Request $request)
    {

        $keywords = $request->input('searchInput', '');

        $product = Product::all();

        $search_product = Product::where('name', 'like', '%' . trim($keywords) . '%')->get();


        return view('admin.product.search', [
            'product' => $product,
            'search_product' => $search_product,

        ]);
    }
}