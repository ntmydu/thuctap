<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(20);
    }
    public function create($request)
    {
        try {
            $randomId = Str::random(10);
            Menu::create([

                'name' => (string)$request->input('name'),
                'parent_id' => (int)$request->input('parent_id'),
                'status' => (int)$request->input('status'),
                'description' => (string)$request->input('description'),
            ]);

            Session::flash('success', 'Tạo Danh Mục Thành Công');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return $request;
    }
    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orwhere('parent_id', $id)->delete();
        }
        return false;
    }
    public function update($request, $menu): bool
    {
        if ($request->input('parent_id') != $menu->id) {
            $menu->parent_id = (int)$request->input('parent_id');
        }

        $menu->name = (string)$request->input('name');
        $menu->description = (string)$request->input('description');
        $menu->status = (string)$request->input('status');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công Danh mục');
        return true;
    }
    public function getId($id)
    {
        return Menu::where('id', $id)->where('status', 1)->firstOrFail();
    }
}