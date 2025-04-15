@extends('fontend.main')
@section('fontend-content')
<div class="container mt-5">
    <form action="{{route('order.add')}}" method="POST">
        @csrf
        <div class="row g-4">
            <!-- Thông tin thanh toán -->
            <div class="col-md-6">
                <h2 class="mb-4">Thông tin thanh toán</h2>
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Họ và tên:</label>
                    <input type="text" readonly class="form-control" name="name" value="{{session('order.name')}}">
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" readonly class="form-control" name="email" value="{{session('order.email')}}">
                </div>
                <div class="form-group mb-3">
                    <label for="note" class="form-label">Ghi chú:</label>
                    <input type="text" readonly class="form-control" name="note" value="{{session('order.note')}}"
                        placeholder="Nhập ghi chú về đơn hàng (nếu có)">
                </div>
            </div>

            <!-- Thông tin liên hệ -->
            <div class="col-md-6">
                <h2 class="mb-4">Thông tin liên hệ</h2>
                <div class="form-group mb-3">
                    <label for="phone" class="form-label">Số điện thoại:</label>
                    <input type="text" readonly class="form-control" name="phone" value="{{session('order.phone')}}">
                </div>
                <div class="form-group mb-3">
                    <label for="address" class="form-label">Địa chỉ:</label>
                    <input type="text" readonly class="form-control" name="address"
                        value="{{session('order.address')}}">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Phương thức thanh toán:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash"
                            required>
                        <label class="form-check-label" for="cash">Thanh toán khi nhận hàng</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer"
                            value="bank_transfer">
                        <label class="form-check-label" for="bank_transfer">Chuyển khoản ngân hàng</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nút hành động -->
        <div class="d-flex justify-content-between mt-4">
            <a href="{{route('order')}}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-primary">Thanh Toán</button>
        </div>
    </form>
</div>
@endsection