<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Slide;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Upload;
use App\Models\Blog;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UesrController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.user.list', [
            'users' => $users
        ]);
    }
    public function formregis()
    {

        return view('regis', [
            'title' => 'Đăng kí thành viên'
        ]);
    }
    public function regis(Request $request)
    {
        // // Tạo người dùng mới
        $randomId = Str::random(10);
        User::create([
            'id' => $randomId,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);



        // // Chuyển hướng đến trang đăng nhập hoặc trang khác
        return view('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
    public function showlogin()
    {
        return view('login');
    }
    public function login(Request $request)
    {

        $menus = Menu::all();
        // $slides = Slide::orderBy('id', 'DESC')->where('status', '1')->take(4)->get();
        $slides =  Slide::orderBy('id', 'DESC')->get();
        $product = Product::all()->take(4);
        $images = Upload::all();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);

                if (Auth::check()) {
                    if (Auth::user()->role == 'admin') {
                        toastify()->success('Đăng nhập thành công', [
                            'duration' => 5000,
                        ]);
                        return redirect()->route('admin');
                    } else {
                        return redirect('/');
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
        session()->forget('user_profile');
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
    public function create()
    {
        return view('admin.user.add');
    }
    public function store(Request $request)
    {
        $users = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect('/admin/user/list')->with('Thêm tài khoản thành công');
        // return $request->name;
    }
    public function view($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.detail', [
            'user' => $user
        ]);
    }
    public function show($id)
    {
        $user = User::findOrFail($id);

        // Trả về view với sản phẩm
        return view('admin.user.edit', [
            'user' => $user
        ]);
    }
    public function update(Request $request, $id)
    {

        // $request->validate([
        //     'name' => 'require|',
        //     'email' => 'require|email|unique:email' . $id,
        //     'phone' => 'nullable|string|max:15',
        //     'address' => 'nullable|string|max:255',
        //     'role_user' => 'required|string|max:50',
        // ]);
        $user = User::FindOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->role_user = $request->input('role_user');


        $user->save();
        return redirect('/admin/user/list')->with('success', 'Cập nhật thành công');
        // return $request->name;
    }
    public function destroy($id)
    {
        $user = User::where('id', $id);
        $user->delete();

        return redirect()->back()->with('success', 'Xóa tài khoản thành công');
    }
    public function search(Request $request)
    {

        $keywords = $request->input('searchInput', '');

        $user = User::all();

        $search_user = User::where('name', 'like', '%' . trim($keywords) . '%')->get();


        return view('admin.user.search', [
            'user' => $user,
            'search_user' => $search_user,

        ]);
    }
    public function showInfo()
    {
        $user = Auth::user();
        return view('fontend.user.info', [
            'user' => $user
        ]);
    }
    public function showChangePass()
    {
        return view('fontend.user.changepass');
    }
    public function changePass(Request $request)
    {
        $user = User::find(Auth::id());
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back();
            toastify()->success('Đổi mật khẩu thành công', [
                'duration' => 5000,
            ]);
        } else {
            return redirect()->back();
            toastify()->error('Mật khẩu cũ không chính xác', [
                'duration' => 5000,
            ]);
        }
    }
}
