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
        $blogs = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,

        ]);

        $image = [];
        if ($files = $request->file('image')) {
            $duoifile = $files->getClientOriginalExtension();
            $tenfile = 'blog' . '-' . rand(0, 99) . '.' . $duoifile;
            $path = "sliders/";

            $files->move($path, $tenfile);
            $tmp = [
                'image' => $path . $tenfile,
                'blog_id' => $blogs->id,
            ];
            $image[] = $tmp;
        }
        Image::insert($image);
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
        $image = [];
        if ($files = $request->file('image')) {
            $img = Image::where('blog_id', $id)->get();
            foreach ($img as $upl) {
                if (File::exists($img->id)) {
                    File::delete(($img->id));
                }
                $img->delete();
            }
            $duoifile = $files->getClientOriginalExtension();
            $tenfile = 'blog' . '-' . rand(0, 99) . '.' . $duoifile;
            $path = "sliders/";

            $files->move($path, $tenfile);
            $tmp = [
                'image' => $path . $tenfile,
                'blog_id' => $blog->id,
            ];
            $image[] = $tmp;
        }
        Image::insert($image);
        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,

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
