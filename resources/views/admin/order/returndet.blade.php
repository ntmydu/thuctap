@extends('admin.main')

@section('content')
<div class="container">
    <a href="/admin/return/order" class="btn btn-dark">Quay Về Danh Sách Đơn Hàng</a>
    <h1>COCOON VIETNAM</h1>
    @if($return)
    <div class="row">
        <label><strong>ID Đơn Hoàn Trả:</strong> {{ $return->id }}</label>
        <p><strong>Ngày đặt:</strong>{{ $return->created_at }}</p>
    </div>
    <div class="row">
        <label for=""><strong>ID Đơn Hàng:</strong> {{ $return->order_id }}</label>
        <label for=""><strong>ID Khách Hàng:</strong> {{ $return->user_id }}</label>
        <label for=""><strong>Lý Do:</strong> {{ $return->reason }}</label>

        @if($return->method == 'return')
        <label for=""><strong>Phương thức hoàn trả: </strong> Đổi hàng lỗi lấy hàng mới
        </label>
        @else
        <label for=""><strong>Phương thức hoàn trả: </strong> Hoàn tiền
        </label>
        @endif

    </div>

    <form action="{{ route('admin.return.edit', $return->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="status">Chọn trạng thái:</label>
            <select style="width:280px" name="status" id="status" class="form-control">
                <option value="unprocess" {{ $return->status == 'unprocess' ? 'selected' : '' }}>Chưa xử lý</option>
                <option value="processed" {{ $return->status == 'processed' ? 'selected' : '' }}>Đã xử lý</option>
            </select>
        </div>
        <button type="submit" class="btn btn-dark">Cập nhật</button>

    </form>
    @else
    <p>Không có thông tin đơn hàng.</p>
    @endif
</div>
@endsection