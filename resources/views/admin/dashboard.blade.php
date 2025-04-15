@extends('admin.main')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Dashboard Admin</h1>
    <div class="card mt-4">
        <div class="card-header">
            <h5>Chọn ngày để thống kê</h5>
        </div>
        <div class="card-body">
            <form action="" method="GET" class="row g-3">
                <div class="col-md-5">
                    <label for="start_date" class="form-label">Từ ngày:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="">
                </div>
                <div class="col-md-5">
                    <label for="end_date" class="form-label">Đến ngày:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Thống kê</button>
                </div>
            </form>
        </div>
        <div class="row">
            <!-- Tổng số đơn hàng -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tổng số đơn hàng</h5>
                        <p class="card-text" style="font-size: 24px;">100 Đơn</p>
                    </div>
                </div>
            </div>

            <!-- Tổng doanh thu -->
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tổng doanh thu</h5>
                        <p class="card-text" style="font-size: 24px;">21.000.000VND</p>
                    </div>
                </div>
            </div>

            <!-- Tổng số khách hàng -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tổng số khách hàng</h5>
                        <p class="card-text" style="font-size: 24px;">80 Người</p>
                    </div>
                </div>
            </div>

            <!-- Tổng số sản phẩm -->
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tổng số sản phẩm</h5>
                        <p class="card-text" style="font-size: 24px;">144 sản phẩm</p>
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

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="" class="btn btn-sm btn-info">Chi tiết</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection