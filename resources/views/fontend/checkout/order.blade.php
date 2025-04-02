@extends('fontend.main')

@section('fontend-content')
<div class="container">
    <form action="{{ route('order.confirm') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <h2>Thông tin thanh toán</h2>
                <div class="form-group">
                    <label for="name">Họ và tên:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                </div>


                <div class="form-group">
                    <label for="note">Ghi chú:</label>
                    <input type="text" class="form-control" id="note" name="note"
                        placeholder="Nhập ghi chú về đơn hàng(Nếu có)">
                </div>

                <button class="btn btn-dark" type="submit">Tiếp tục</button>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Số điện thoại:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại"
                        required>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ"
                        required>
                </div>

            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-6">
            <h2>Xem lại giỏ hàng của bạn</h2>
        </div>
    </div>
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <th class="title">Sản phẩm</th>
                    <th class="title">Giá</th>
                    <th class="title">Số lượng</th>
                    <th class="title">Tổng cộng</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0  ?>
                @if(session('cart'))
                @foreach(session('cart') as $id => $product)
                <tr>
                    <td class="cart_product">
                        <a href="">
                            <img src="{{asset($product['image'])}}" alt="" width="50px">
                        </a>
                        <div class="cart_description">
                            <h4><a href="">{{ $product['name']}}</a></h4>

                        </div>
                    </td>
                    <td class="cart_price">
                        <p>{{number_format($product['price'])}}đ</p>
                    </td>
                    <td class="cart_quantity">

                        <div class="cart_quantity_button">

                            <input class="cart_quantity_input" type="text" name="quantity"
                                value="{{$product['quantity']}}" min="1" autocomplete="off" size="2"
                                style="border: 1px solid" readonly>
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">
                            {{number_format($product['price'] * $product['quantity'])}}đ
                        </p>
                    </td>
                </tr>
                @endforeach
                @endif


            </tbody>
            <tfoot>
                <tr>

                    <td colspan="3" class="font-weight-bold">Tổng Cộng</td>
                    <td class="font-weight-bold">{{number_format($totalAmount, 0, ',', '.')}}đ</td>
                </tr>
            </tfoot>
        </table>
    </div>



    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>