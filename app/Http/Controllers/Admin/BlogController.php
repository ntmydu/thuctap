<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blog.list', [
            'blogs' => $blogs,
        ]);
    }
    public function create()
    {
        return view('admin.blog.add');
    }
    public function store(Request $request)
    {

        $file = $request->image;


        if ($file) {
            $duoifile = $file->getClientOriginalExtension();
            $tenfile = 'blog' . '-' . rand(0, 99) . '.' . $duoifile;
            $path = "sliders/";
            $blogs = Blog::create([
                'title' => $request->title,
                'content' => $request->content,
                'author' => $request->author,
                'image' => $tenfile,
            ]);
            $file->move($path, $tenfile);
            $blogs->image = $tenfile;
        }

        $blogs->save();
        toastify()->success('Thêm bài viết thành công', [
            'duration' => 5000,
        ]);
        return redirect()->back();
    }

    public function show($id)
    {
        $blog = Blog::find($id);

        return view('admin.blog.edit', [
            'blog' => $blog,
        ]);
    }
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'image' => $request->image,
        ]);
        toastify()->success('Cập nhật bài viết thành công', [
            'duration' => 5000,
        ]);
        toastify()->success('Cập nhật thành công', [
            'duration' => 2000,
        ]);
        return redirect('admin/blog/list');
    }
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        toastify()->success('Xóa bài viết thành công', [
            'duration' => 5000,
        ]);
        return redirect()->back();
    }
}