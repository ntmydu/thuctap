@extends('admin.main')


@section('header')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
@endsection

@section('content')
<form action="{{route ('user.update', $user->id)}}" method="POST">
    @csrf
    <div class="cart-body">
        <div class="row">
            <div class="form-group">
                <label for="">Tên khách hàng</label>
                <input type="text" name="name" class="form-control" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" value="{{$user->phone}}">
            </div>
            <div class="form-group">
                <label for="">Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="{{$user->address}}">
            </div>
            <div class="form-group">
                <label for="">Vai trò</label>
                <input type="text" name="role_user" class="form-control" value="{{$user->role_user}}">
            </div>
        </div>
    </div>
    <div>

        <button type="submit" class="btn btn-success">Cập nhật</button>

    </div>
</form>

@endsection
@section('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>




@endsection