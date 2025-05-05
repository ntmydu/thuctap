@extends('fontend.main')
@section('fontend-content')

<div class="container mt-5">
    <h2 class="text-center mb-4">Chi tiết đơn hàng</h2>

    <!-- Thông tin đơn hàng -->
    <div class="card mb-4">
        <div class="card-header">
            <strong>Mã đơn hàng:</strong> {{ $order->id }}
        </div>
        <div class="card-body">
            <p><strong>Ngày đặt:</strong> {{ $order->created_at }}</p>
            <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
            <p><strong>Tổng tiền:</strong> {{ number_format($order->price, 0, ',', '.') }} VND</p>
            <p><strong>Địa chỉ giao hàng:</strong> {{ $order->address }}</p>
            <p><strong>Ghi chú:</strong> {{ $order->note ?? 'Không có ghi chú' }}</p>
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <h4 class="mb-3">Danh sách sản phẩm</h4>
    <table class="table table-bordered">
        <thead>
            <tr>

                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productOrd as $detail)
            <tr>

                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->price, 0, ',', '.') }} VND</td>
                <td>{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }} VND</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tổng cộng -->
    <div class="text-end mt-3">
        <h5><strong>Tổng cộng:</strong> {{ number_format($order->price, 0, ',', '.') }} VND</h5>
    </div>

    <!-- Nút quay lại -->
    <div class="mt-4">
        <a href="{{ route('order.management') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</div>

@endsection