@extends('admin.main')
@include('admin.navbar')
@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Dashboard Admin</h1>

    <div class="card mt-4">
        <div class="card-header">
            <h5>Chọn thời gian để thống kê</h5>
        </div>
        <div class="card-body">

            <!-- Nút thống kê nhanh -->
            <div class="col-md-12 d-flex  flex-wrap gap-2 mb-3">
                <form action="/admin/statistics/today" method="GET" class="">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary me-2">Hôm nay</button>
                </form>
                <form action="/admin/statistics/week" method="GET" class="">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary me-2">Tuần này</button>
                </form>
                <form action="/admin/statistics/month" method="GET" class="">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary me-2">Tháng này</button>
                </form>
                <form action="/admin/statistics/year" method="GET" class="">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary">Năm nay</button>
                </form>
            </div>
            <form action="/admin/statistic" method="GET" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Từ ngày:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control"
                        value="{{ request('start_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Đến ngày:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control"
                        value="{{ request('end_date') }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Thống kê</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Thống kê tổng quan -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng số đơn hàng</h5>
                    <p class="card-text" style="font-size: 24px;">{{ $totalOrders }} Đơn</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng doanh thu</h5>
                    <p class="card-text" style="font-size: 24px;">{{ number_format($totalRevenue, 0, ',', '.') }} VND
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng số khách hàng</h5>
                    <p class="card-text" style="font-size: 24px;">{{ $totalCustomers }} Người</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tổng số sản phẩm</h5>
                    <p class="card-text" style="font-size: 24px;">{{ $totalProducts }} Sản phẩm</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bảng thống kê đơn hàng -->
    <div class="card mt-4">
        <div class="card-header">
            <h5>Đơn hàng mới nhất</h5>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name_customer }}</td>
                        <td>{{ number_format($order->price, 0, ',', '.') }} VND</td>
                        <td>
                            @if($order->status == 'pending')
                            <span class="badge bg-warning">Đang giao hàng</span>
                            @elseif($order->status == 'delivered')
                            <span class="badge bg-success">Đã giao</span>
                            @elseif($order->status == 'cancelled')
                            <span class="badge bg-danger">Đã hủy</span>
                            @elseif($order->status == 'reviewed')
                            <span class="badge bg-info">Đã đánh giá</span>
                            @elseif($order->status == 'confirmed')
                            <span class="badge bg-primary">Đã xác nhận</span>
                            @else
                            <span class="badge bg-secondary">Chưa xác nhận</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <a href="/admin/order/list" class="btn btn-sm btn-info">Chi tiết</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection