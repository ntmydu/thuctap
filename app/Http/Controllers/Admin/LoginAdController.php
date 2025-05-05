<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Slide;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Upload;
use App\Models\Blog;
use App\Models\Image;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAdController extends Controller
{
    public function index()
    {
        return view('admin.loginAd', [
            'title' => 'Đăng nhập admin'
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', '=', $request->email)->first();


        if ($user) {
            if (Hash::check($request->password, $user->password)) { // Kiểm tra mật khẩu có đúng không
                Auth::login($user); // Tạo Auth bằng thông tin user

                if (Auth::check()) { // Kiểm tra có tồn tại Auth hay không
                    if (Auth::user()->role == 'admin') { // Kiểm tra vai trò là admin
                        toastify()->success('Đăng nhập thành công', [
                            'duration' => 5000,
                        ]);
                        return redirect()->route('admin');
                    } else {
                        toastify()->error('Không có quyền đăng nhập', [
                            'duration' => 5000,
                        ]);
                        return redirect()->back();
                    }
                } else {
                    toastify()->error('Có lỗi khi đăng nhập', [
                        'duration' => 5000,
                    ]);
                    return redirect()->back(); // Trả về hiện tại khi không tồn tại Auth
                }
            } else {
                toastify()->error('Mật khẩu không chính xác', [
                    'duration' => 5000,
                ]);
                return redirect()->back(); // Trả về hiện tại khi không tồn tại Auth
            }
        } else {
            toastify()->error('Tài khoảng không tồn tại', [
                'duration' => 5000,
            ]);
            return redirect()->back(); // Trả về hiện tại khi không tồn tại Auth
        }
    }
    public function logout()
    {
        $menus = Menu::all();
        // $slides = Slide::orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        $slides =  Slide::orderBy('id', 'DESC')->get();
        $product = Product::all()->take(4);
        $images = Upload::all();
        $blogs = Blog::all()->take(3);
        $imageBlog = Image::all();
        Auth::logout();

        return view(
            'fontend.home',
            [
                'slides' => $slides,
                'menus' => $menus,
                'products' => $product,
                'images' => $images,
                'blogs' => $blogs,
                'imageBlog' => $imageBlog
            ]
        );
    }
}