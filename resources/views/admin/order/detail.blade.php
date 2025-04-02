@extends('admin.main')

@section('content')
<div class="container">
    <h1>COCOON VIETNAM</h1>
    @if($order)
    <div class="row">
        <p><strong>ID Đơn Hàng:</strong> {{ $order->id }}</p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""><strong>Người gửi:</strong> CocoonVietNam</label>
                <p><strong>Địa chỉ:</strong> Đường Nguyễn Thị Minh Khai, Quận 1, Thành phố Hồ Chí Minh</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><strong>Tên Khách Hàng:</strong> {{ $customer->name  }}</label>
                <p><strong>Số Điện Thoại:</strong> {{ $customer->phone}}</p>
                <label><strong>Email Khách Hàng:</strong> {{$customer->email}}</label>
                <p><strong>Địa Chỉ:</strong> {{$customer->address}}</p>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="form-group">
            <strong>Nội dung hàng (Tổng SL sản phẩm: {{$order->quantity}})</strong>
            <table>
                <thead>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td colspan="2">{{$product->name}}</td>
                        <td></td>
                        <td>SL: {{$product->quantity}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>



    </div>
    <div class="row">
        <p><i>Tiền thu người nhận:</i> <strong>{{number_format($order->price, 0, ',', '.')}} VND</strong> </p>
    </div>







    <a href="" class="btn btn-dark">Quay Về Danh Sách Đơn Hàng</a>
    @else
    <p>Không có thông tin đơn hàng.</p>
    @endif
</div>
@endsection