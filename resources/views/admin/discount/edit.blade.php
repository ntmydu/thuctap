@extends('admin.main')

@section('header')
<script src="/public/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="{{route('discount.update', $discount->id)}}" method="POST">
    <div class="card-body">
        <div class="form-group">
            <label for="">Tên chương trình khuyến mãi</label>
            <input type="text" name="name" value="{{ $discount->name}}" class="form-control"
                placeholder="Nhập tên danh mục">
        </div>
        <div class="form-group">
            <label>Mã giảm giá </label>
            <input type="text" name="code" id='code' class="form-control" value="{{$discount->code}}">
        </div>
        <div class="form-group">
            <label>Số lượng mã giảm</label>
            <input type="text" name="usage_limit" id='usage_limit' class="form-control"
                value="{{$discount->usage_limit}}">
        </div>

        <div class="form-group">
            <label for="formality">Hình thức giảm giá</label>
            <select class="form-control" name="formality" id="formality">
                <option value="percent" {{ $discount->formality == 'percent' ? 'selected' : '' }}>Giảm theo phần trăm
                </option>
                <option value="money" {{ $discount->formality == 'money' ? 'selected' : '' }}>Giảm theo số tiền mặc
                    định</option>
            </select>
        </div>

        <div class="form-group">
            <label>Giá trị của mã giảm</label>
            <input type="number" name="valuation" id='valuation' class="form-control" value="{{$discount->valuation}}">
        </div>

        <!-- <div class="form-group">
            <label>Mô Tả Chi Tiết</label>
            <textarea name="content" id="content" class="form-control"></textarea>
        </div> -->
        <div class="form-group">
            <label>Ngày bắt đầu</label>
            <input type="text" name="start" id='start' class="form-control" value="{{$discount->start}}">
        </div>
        <div class="form-group">
            <label>Ngày kết thúc</label>
            <input type="text" name="end" id='end' class="form-control" value="{{$discount->end}}">
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </div>
    @csrf
</form>
@endsection

@section('footer')
<script>
CKEDITOR.replace('description');
</script>
@endsection