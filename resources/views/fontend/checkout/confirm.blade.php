@extends('fontend.main')
@section('fontend-content')
<div class="container">
    <div class="row">
        <form action="{{route('order.add')}}" method="POST">
            @csrf
            <div class="col-md-6">

                <h2>Thông tin thanh toán</h2>


                <div class="form-group">
                    <label for="name">Họ và tên:</label>
                    <input type="text" readonly class="form-control" name="name" value="{{session('order.name')}}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" readonly class="form-control" name="email" value="{{session('order.email')}}">
                </div>


                <div class="form-group">
                    <label for="note">Ghi chú:</label>
                    <input type="text" readonly class="form-control" name="note" value="{{session('order.note')}}"
                        placeholder="Nhập ghi chú về đơn hàng(Nếu có)">
                </div>
                <div id="dis" class="form-group">
                    <label class="discount-lab" readonly for="note">Mã giảm giá:</label>
                    <input class="discount" type="text" class="form-control" placeholder="Nhập mã giảm giá">
                    <button class="btn btn-dark">Áp dụng</button>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Số điện thoại:</label>
                    <input type="text" readonly class="form-control" name="phone" placeholder="Nhập số điện thoại"
                        value="{{session('order.phone')}}">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" readonly class="form-control" name="address" value="{{session('order.address')}}"
                        placeholder="Nhập địa chỉ" required>
                </div>

                <div class="form-group">
                    <label>Phương Thức Thanh Toán:</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash"
                            required>
                        <label class="form-check-label" for="credit_card">Thanh toán khi nhận hàng</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer"
                            value="bank_transfer">
                        <label class="form-check-label" for="bank_transfer">Chuyển Khoản Ngân Hàng</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Thanh Toán</button>

        </form>
        <a href="{{route('order')}}">
            <button>Quay lại</button>
        </a>

    </div>
</div>
@endsection