@extends('admin.main')

@section('content')
<div class="container">
    <a href="/admin/order/list" class="btn btn-dark">Quay Về Danh Sách Đơn Hàng</a>
    <h1>COCOON VIETNAM</h1>
    @if($order)
    <div class="row">
        <label><strong>ID Đơn Hàng:</strong> {{ $order->id }}</label>
        <p><strong>Ngày đặt:</strong>{{ $order->created_at }}</p>
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
                <label><strong>Tên Khách Hàng:</strong> {{ $order->name_customer  }}</label>
                <p><strong>Số Điện Thoại:</strong> {{ $order->phone}}</p>
                <label><strong>Email Khách Hàng:</strong> {{$order->email}}</label>
                <p><strong>Địa Chỉ:</strong> {{$order->address}}</p>
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

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="status">Chọn trạng thái:</label>
            <select style="width:200px" name="status" id="status" class="form-control">
                <option value="unconfirmed" {{ $order->status == 'unconfirmed' ? 'selected' : '' }}>Chờ xác nhận
                </option>
                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Đã xác
                    nhận
                </option>
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Đang giao</option>
                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã giao</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                <option value="reviewed" {{ $order->status == 'reviewed' ? 'selected' : '' }}>Đã đánh giá</option>
            </select>
        </div>
        <button type="submit" class="btn btn-dark">Cập nhật</button>
    </form>






    @else
    <p>Không có thông tin đơn hàng.</p>
    @endif
</div>
@endsection