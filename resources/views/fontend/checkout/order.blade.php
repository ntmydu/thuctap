@extends('fontend.main')

@section('fontend-content')
<div style="font-size: medium;" class="container mt-5">
    <form action="{{ route('order.confirm') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Thông tin thanh toán -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-12">
                        <h2 class="mb-4">Thông tin thanh toán</h2>
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Họ và tên:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Số điện thoại:</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Địa chỉ:</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Nhập địa chỉ" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="note" class="form-label">Ghi chú:</label>
                            <textarea class="form-control" id="note" name="note" rows="3"
                                placeholder="Nhập ghi chú về đơn hàng (nếu có)"></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-dark" style="width: 100%; margin-left: 0;" type="submit">Tiếp
                                tục</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Xem lại giỏ hàng -->
            <div class="col-md-6">
                <h2 class="mb-4">Xem lại giỏ hàng của bạn</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng cộng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0 ?>
                            @if(session('cart'))
                            @foreach(session('cart') as $id => $product)
                            <tr>
                                <td class="cart_product">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($product['image']) }}" alt="" width="50px" class="me-3">
                                        <div>
                                            <h6 class="mb-0">{{ $product['name'] }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart_price">
                                    <p>{{ number_format($product['price']) }}đ</p>
                                </td>
                                <td class="cart_quantity">
                                    <input class="form-control text-center" type="text" name="quantity"
                                        value="{{ $product['quantity'] }}" min="1" readonly>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        {{ number_format($product['price'] * $product['quantity']) }}đ
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Tổng Cộng</td>
                                <td class="fw-bold">{{ number_format($totalAmount, 0, ',', '.') }}đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>