@extends('admin.main')

@section('header')
<script src="/public/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="{{ route ('user.store')}}" method="POST">
    <div class="card-body">

        <div class="form-group">
            <label for="menu">Tên khách hàng</label>
            <input type="text" name="name" class="form-control" placeholder="Nhập tên của bạn">
        </div>

        <div class="form-group">
            <label>Email </label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                placeholder="Nhập mật khẩu">
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success">Tạo tài khoản</button>
    </div>
    @csrf
</form>
@endsection

@section('footer')
<script>
CKEDITOR.replace('description');
</script>
@endsection