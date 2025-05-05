<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Image;
use Illuminate\Support\Facades\File;
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
        $request->validate([
            'image.*' => 'image | mimes:png,jpg,jpeg,webp'
        ]);

        $file = $request->image;
        if ($file) {
            $duoifile = $file->getClientOriginalExtension();
            $tenfile = 'slider' . '-' . rand(0, 99) . '.' . $duoifile;
            $path = "sliders/";
            $file->move($path, $tenfile);
            Blog::create([
                'title' => $request->title,
                'content' => $request->content,
                'author' => $request->author,
                'image' => $tenfile,
            ]);
        }
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
        $file = $request->image;
        if ($file) {
            $duoifile = $file->getClientOriginalExtension();
            $tenfile = 'blog' . '-' . rand(0, 99) . '.' . $duoifile;
            $path = "sliders/";
            $file->move($path, $tenfile);
            $blog->image = $tenfile;
            $blog->save();
        }

        if ($request->title) {
            $blog->title = $request->title;
        }

        if ($request->content) {
            $blog->content = $request->content;
        }

        if ($request->author) {
            $blog->author = $request->author;
        }

        if ($request->status) {
            $blog->status = $request->status;
        }

        $blog->save();

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
