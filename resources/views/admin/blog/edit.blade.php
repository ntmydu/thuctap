@extends('admin.main')


@section('header')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
@endsection

@section('content')
<form action="{{route('blog.update', $blog->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="cart-body">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label for="">Tên chủ đề</label>
                    <input type="text" name="title" class="form-control" value="{{$blog->title}}">
                    @error('title')
                    <small class="help-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Tên tác giả</label>
                    <input type="text" name="author" class="form-control" value="{{$blog->author}}">
                    @error('author')
                    <small class="help-block">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Nội dung</label>
                    <textarea name="content" id="content" class="form-control">{{$blog->content}}</textarea>
                    @error('content')
                    <small class="help-block">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Ảnh đại diện</label>
                    <input type="file" name="images" class="form-control" id="image_name" multiple>
                    <img src="{{ asset('sliders/' . $blog->image) }}" height="40px">
                    @error('image')
                    <small class="help-block">{{$message}}</small>
                    @enderror


                </div>
            </div>






            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="status"
                        {{ $blog->status == 1 ? 'checked=""' : ''}}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="status"
                        {{ $blog->status == 0 ? 'checked=""' : ''}}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>
    </div>
    <div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </div>
    </div>

</form>

@endsection
@section('footer')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>

<script>
    $('#description').summernote({
        placeholder: 'Nhập mô tả chi tiết của sản phẩm',
        tabsize: 2,
        height: 100
    });
</script>

<script>
    $('#content').summernote({
        placeholder: 'Nhập nội dung bài viết',
        tabsize: 2,
        height: 100
    });
</script>
@endsection