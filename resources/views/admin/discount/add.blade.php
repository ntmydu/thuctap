@extends('admin.main')

@section('header')
<script src="/public/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="{{route('discount.store')}}" method="POST">
    <div class="card-body">

        <div class="form-group">
            <label for="">Tên chương trình khuyến mãi</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập tên ">
        </div>
        <div class="form-group">
            <label>Mã giảm giá </label>
            <input type="text" name="code" id='code' class="form-control" placeholder="Nhập mã ">
        </div>
        <div class="form-group">
            <label>Số lượng mã giảm</label>
            <input type="text" name="usage_limit" id='usage_limit' class="form-control" placeholder="Nhập số lượng ">
        </div>

        <div class="form-group">
            <label>Hình thức giảm</label>
            <select class="form-control" name="formality">
                <option value="percent">Giảm theo phần trăm</option>

                <option value="money">Giảm theo số tiền mặc định</option>

            </select>
        </div>

        <div class="form-group">
            <label>Giá trị của mã giảm</label>
            <input type="number" name="valuation" id='valuation' class="form-control" placeholder="Nhập giá trị ">
        </div>

        <!-- <div class="form-group">
            <label>Mô Tả Chi Tiết</label>
            <textarea name="content" id="content" class="form-control"></textarea>
        </div> -->
        <div class="form-group">
            <label>Ngày bắt đầu</label>
            <input type="text" name="start" id='start' class="form-control" placeholder="Nhập ngày ">
        </div>
        <div class="form-group">
            <label>Ngày kết thúc</label>
            <input type="text" name="end" id='end' class="form-control" placeholder="Nhập ngày">
        </div>


    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success">Tạo Danh Mục</button>
    </div>
    @csrf
</form>
@endsection

@section('footer')
<script>
    CKEDITOR.replace('description');
</script>
@endsection