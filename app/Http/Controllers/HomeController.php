<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Upload;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $menus = Menu::all();
        // $slides = Slide::orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        $slides =  Slide::orderBy('id', 'DESC')->get();
        $product = Product::all()->take(4);
        $blogs = Blog::all()->take(3);
        $images = Upload::all();
        return view('fontend.home', [
            'slides' => $slides,
            'menus' => $menus,
            'products' => $product,
            'images' => $images,
            'blogs' => $blogs
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
    public function show()
    {
        return view('fontend.password.forget');
    }
    public function request(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users'
        ]);
        $user = User::where('email', $request->email)->first();

        $token = strtoupper(Str::random(10));
        $user->token = $token;
        $user->save();

        Mail::send(
            'fontend.email.code',
            [
                'user' => $user,
                'token' => $token
            ],
            function ($email) use ($user) {
                $email->subject('COCOONVIETNAM-Lấy lại mật khẩu');
                $email->to($user->email);
            }
        );

        toastify()->success('Đã gửi mã xác nhận đến mail của bạn.', [
            'duration' => 5000,
        ]);
        return redirect()->route('view.recover');
    }
    public function showview()
    {
        return view('fontend.password.recover');
    }
    public function recover(Request $request, User $user)
    {
        // Xác thực dữ liệu
        $request->validate([
            'token' => 'required',
        ]);

        $user = User::where('token', $request->token)->first();

        if ($user) {

            return view('fontend.password.newpass', [
                'token' => $request->token
            ]);
        }

        toastify()->error('Mã xác nhận không chính xác', [
            'duration' => 5000,
        ]);

        // Nếu không khớp, có thể thêm thông báo lỗi
        return back()->withErrors(['token' => 'Token không hợp lệ.']);
    }
    public function newpass(Request $request)
    {
        return view('fontend.password.newpass');
    }
    public function updatepass(Request $request)
    {

        if ($request->password !== $request->confirm_password) {
            toastify()->error('Nhập lại mật khẩu không chính xác', [
                'duration' => 5000,
            ]);

            return view('fontend.password.newpass', [
                'token' => $request->token
            ]);
        }
        $user = User::where('token', $request->token)->first();
        if ($user) {
            $pass = bcrypt($request->password);
            $user->token = null;
            $user->password = $pass;
            $user->save();
            toastify()->success('Cập nhật mật khẩu thành công', [
                'duration' => 5000,
            ]);

            return redirect()->route('view.login');
        }

        toastify()->error('Người dùng không tồn tại', [
            'duration' => 5000,
        ]);

        return view('fontend.password.newpass', [
            'token' => $request->token
        ]);
    }

    public function testMail()
    {
        set_time_limit(60);
        $name = 'Quý khách'; // Tên người nhận

        Mail::send('fontend.order.mail', ['name' => $name], function ($email) use ($name) {
            $email->to('ntmydu1706@gmail.com', $name) // Địa chỉ email và tên hiển thị
                ->subject('Xác nhận đơn hàng'); // Tiêu đề email
        });
    }
}