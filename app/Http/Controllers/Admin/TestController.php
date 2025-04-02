<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\test;

class TestController extends Controller
{
    public function create()
    {
        return view('admin.test');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Tạo ID ngẫu nhiên cho sản phẩm
        $randomId = Str::random(10);

        // Tạo sản phẩm mới
        $test = Test::create([
            'id' => $randomId,
            'name' => $request->name,
        ]);

        return redirect()->back();
    }
}