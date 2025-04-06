@extends('fontend.main')
@section('fontend-content')

<nav class="title-nav">
    <h2>Quản lý Đơn hàng</h2>
    <div style="display:flex;" class="row">
        <div style="width:200px;" class="form-group"> <a href="{{route('order.management')}}">Chờ xác nhận</a></div>
        <div style="width:200px;" class="form-group"><a href="{{route('order.pending')}}">Đơn hàng đang giao</a></div>
        <div style="width:200px;" class="form-group"> <a href="{{route('order.delivered')}}">Đơn hàng đã giao</a></div>
        <div style="width:200px;" class="form-group"><a href="{{route('order.cancelled')}}">Đơn hàng đã hủy</a></div>

    </div>
    </div>





</nav>
<div class="container">

    <form action=""></form>
    <div class="order-status">


        <ul class="list-group">
            @foreach($orderCancelled as $order)
            <li class="list-group-item">
                <strong>Mã đơn hàng:</strong>{{$order->id}}<br>

                <strong>Ngày đặt:</strong>{{$order->created_at}}<br>
                <strong>Tổng tiền:</strong>{{number_format($order->price, 0, ',', '.')}}
            </li>
            <a href="">Xem chi tiết</a>

            @endforeach
        </ul>


    </div>
</div>

@endsection