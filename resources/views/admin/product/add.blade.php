@extends('admin.main')


@section('header')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
@endsection

@section('content')
<form action="/admin/product/add" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="cart-body">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label for="">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm">
                    @error('name')
                    <small class="help-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea type="text" name="content" class="form-control"
                        placeholder="Nhập mô tả sản phẩm"></textarea>
                    @error('content')
                    <small class="help-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Mô tả chi tiết sản phẩm</label>
                    <textarea name="description" id="description" class="form-control"
                        placeholder="Nhập mô tả sản phẩm"></textarea>
                    @error('description')
                    <small class="help-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Danh sách ảnh</label>
                    <input type="file" name="images[]" class="form-control" id="image_name" multiple>
                    @error('image_list')
                    <small class="help-block">{{$message}}</small>
                    @enderror


                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Danh mục</label>

                    <select class="form-control" name="menu_id">
                        @foreach($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                    </select>
                    @error('name')
                    <small class="help-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Số lượng</label>
                    <input type="text" name="stock" class="form-control" placeholder="Nhập số lượng">
                    @error('stock')
                    <small class="help-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Giá sản phẩm</label>
                    <input type="text" name="price" class="form-control" placeholder="Nhập giá sản phẩm">
                    @error('price')
                    <small class="help-block">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Giá giảm</label>
                    <input type="text" name="price_sale" class="form-control" placeholder="Nhập giá giảm">
                    @error('price_sale')
                    <small class="help-block">{{$message}}</small>
                    @enderror
                </div>
                <!-- <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="file_upload" class="form-control" placeholder="Nhập giá sản phẩm">
                @error('image')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div> -->
                <div class="form-group">
                    <label for="">Kích hoạt</label>
                    <div class="radio">
                        <label for="">
                            <input type="radio" name="status" value="1">
                            Có
                        </label>
                        <label for="">
                            <input type="radio" name="status" value="0">
                            Không
                        </label>
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


@endsection