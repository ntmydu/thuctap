@extends('admin.main')

@section('header')
<script src="/public/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="{{route ('slide.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="menu">Tiêu đề</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập tiêu đề">
        </div>

        <div class="form-group">
            <label>Link</label>
            <input type="text" name="url" id='url' class="form-control" placeholder="Nhập đường link">
        </div>

        <div class="form-group">
            <label for="">Hình ảnh </label>
            <input type="file" name="image" class="form-control" id="image">
            @error('image_list')
            <small class="help-block">{{$message}}</small>
            @enderror
        </div>

        <!-- <div class="form-group">
            <label>Mô Tả Chi Tiết</label>
            <textarea name="content" id="content" class="form-control"></textarea>
        </div> -->


        <div class="form-group">
            <label>Trạng thái</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="1" type="radio" id="active" name="status" checked="">
                <label for="active" class="custom-control-label">Hiện</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="0" type="radio" id="no_active" name="status">
                <label for="no_active" class="custom-control-label">Ẩn</label>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success">Tạo slide</button>
    </div>
    @csrf
</form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('description');
</script>
@endsection