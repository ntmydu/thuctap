@extends('admin.main')


@section('header')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
@endsection

@section('content')
<form action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="cart-body"></div>
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="{{$product->name}}"
                    placeholder="Nhập tên sản phẩm">
                @error('name')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Mô tả</label>
                <textarea type="text" name="content" class="form-control">{{$product->content}}</textarea>
                @error('content')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Mô tả chi tiết sản phẩm</label>
                <textarea name="description" id="description" class="form-control">{{$product->description}}</textarea>
                @error('description')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Hướng dẫn sử dụng</label>
                <textarea name="instructions" id="instructions"
                    class="form-control">{{$product->instructions}}</textarea>
                @error('instructions')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Danh sách ảnh</label>
                <div class="list-images">
                    @foreach($images as $image)
                    <img src="{{ asset($image->image_name) }}" alt="123" width="100px">
                    @endforeach
                </div>
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
                    <option value="{{ $menu->id }}" {{$product->menu_id === $menu->id ? 'selected' : ''}}>
                        {{ $menu->name }}
                    </option>
                    @endforeach
                </select>
                @error('name')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Số lượng</label>
                <input type="text" name="stock" class="form-control" value="{{$product->stock}}">
                @error('stock')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Giá sản phẩm</label>
                <input type="text" name="price" class="form-control" value="{{$product->price}}">
                @error('price')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Giá giảm</label>
                <input type="text" name="price_sale" class="form-control" value="{{$product->price_sale}}">
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
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="status"
                        {{ $product->status == 1 ? 'checked=""' : ''}}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="status"
                        {{ $product->status == 0 ? 'checked=""' : ''}}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>
        </div>
    </div>
    <div>
        <button type="submit" class="btn btn-success">Cập nhật </button>
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
    placeholder: 'Hello Bootstrap 4',
    tabsize: 2,
    height: 100
});
</script>
@endsection