<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class DiscountController extends Controller
{
    public function create()
    {
        return view('admin.discount.add');
    }
    public function store(Request $request)
    {
        $discounts = Discount::create($request->all());
        return redirect()->back()->with('success', 'Thêm mã thành công. ');
    }
    public function index()
    {
        $discounts = Discount::orderBy('created_at', 'DESC')->get();
        return view('admin.discount.list', [
            'discounts' => $discounts
        ]);
    }
    public function show($id)
    {
        $discount = Discount::findOrFail($id);

        return view('admin.discount.edit', [
            'discount' => $discount
        ]);
    }
    public function update(Request $request, $id)
    {
        $discounts = Discount::findOrFail($id);
        $discounts->name = $request->input('name');
        $discounts->code = $request->input('code');
        $discounts->usage_limit = $request->input('usage_limit');
        $discounts->formality = $request->input('formality');
        $discounts->valuation = $request->input('valuation');
        $discounts->start = $request->input('start');
        $discounts->end = $request->input('end');
        $discounts->save();
        return redirect('/admin/discount/list')->with('success', 'Cập nhật thành công');
    }
    public function destroy($id)
    {

        $dicount = Discount::find($id);
        $dicount->delete();

        return redirect()->back()->with('success', 'Xóa mã giảm thành công');
    }
    public function search(Request $request)
    {

        $keywords = $request->input('searchInput', '');

        $discount = Discount::all();

        $search_discount = Discount::where('name', 'like', '%' . trim($keywords) . '%')->get();


        return view('admin.discount.search', [
            'discount' => $discount,
            'search_discount' => $search_discount,

        ]);
    }
    public function send($id)
    {
        $users = User::get();
        $discount = Discount::where('id', $id)->first();

        foreach ($users as $user) {
            Mail::send('fontend.email.discount', ['discount' => $discount], function ($email) use ($user) {
                $email->to($user->email, $user->name)
                    ->subject('Chương trình khuyến mãi giảm giá từ COCOONVIETNAM'); // Tiêu đề email
            });
        }

        return redirect()->back();
    }
}