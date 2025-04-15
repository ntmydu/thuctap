@extends('fontend.main')
@section('fontend-content')
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div style="font-size:medium ;" class="container">
        <h2>Yêu Cầu Hoàn Tiền/Trả Hàng</h2>
        <form action="{{ route('request.return') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="order_id">Mã đơn hàng:</label>
                <input type="text" id="order_id" name="order_id" class="form-control" value="{{$order->id}}">
            </div>

            <div class="form-group">
                <label for="reason">Lý do:</label>
                <textarea id="reason" name="reason" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label>Phương Thức Thanh Toán:</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="method" id="return" value="return" required>
                    <label class="form-check-label" for="return">Hoàn hàng cũ lấy hàng mới</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="method" id="refund" value="refund">
                    <label class="form-check-label" for="refund">Hoàn tiền</label>
                </div>
            </div>
            <p><strong>Lưu ý:</strong>Sau khi quý khách gửi yêu cầu hoàn trả , vui lòng gửi <strong>mã đơn
                    hàng</strong>,
                video khui hàng và ảnh hàng lỗi qua zalo của CocoonVietNam: <strong>0989999888</strong>(sẽ được xử lý
                nhanh hơn) hoặc
                email: <strong>cocoonvn@gmail.com</strong></p>

            <button type="submit" class="btn btn-dark">Gửi Yêu Cầu</button>
        </form>
    </div>
</section>
@endsection