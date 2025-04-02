@extends('admin.main')

@section('header')
<script src="/public/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="{{route('add')}}" method="POST">
    <div class="card-body">

        <div class="form-group">
            <label for="menu">Tên Danh Mục</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục">
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