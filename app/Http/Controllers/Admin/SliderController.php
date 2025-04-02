<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slide;
use Faker\Guesser\Name;



class SliderController extends Controller
{
    public function index()
    {
        $slides =  Slide::orderBy('id', 'DESC')->get();
        return view('admin.slide.list', [
            'slides' => $slides
        ]);
    }
    public function create()
    {
        return view('admin.slide.add');
    }
    public function store(Request $request)
    {
        $slides = Slide::create($request->all());
        $file = $request->image;

        if ($file) {
            $duoifile = $file->getClientOriginalExtension();
            $tenfile = 'slider' . '-' . rand(0, 99) . '.' . $duoifile;
            $path = "sliders/";
            $file->move($path, $tenfile);
            $slides->image = $tenfile;
        }
        $slides->save();
        return redirect('/admin/slide/list')->with('success', 'Thêm slide thành công');
    }
    public function show($id)
    {
        $slides = Slide::findOrFail($id);

        return view('admin.slide.edit', [
            'slides' => $slides
        ]);
    }
    public function update(Request $request, $id)
    {
        $slide = Slide::where('id', $id)->first();
        $file = $request->image;

        if ($file) {
            $duoifile = $file->getClientOriginalExtension();
            $tenfile = 'slider' . '-' . rand(0, 99) . '.' . $duoifile;
            $path = "sliders/";
            $file->move($path, $tenfile);
            $slide->image = $tenfile;
        }

        if ($request->name) {
            $slide->name =  $request->name;
        }

        if ($request->url) {
            $slide->url =  $request->url;
        }

        if ($request->status) {
            $slide->status =  $request->status;
        }

        $slide->save();
        return redirect('/admin/slide/list')->with('success', 'Cập nhật slide thành công');
    }
    public function destroy($id)
    {
        $slides = slide::find($id);
        $slides->delete();

        return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
    }
}
