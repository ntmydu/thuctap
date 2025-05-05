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
@if($orderUnconfirmed)
<div class="container">
    @foreach($orderUnconfirmed as $order)
    <form action="{{route('cancel.order', $order->id)}}" method="POST">
        @csrf
        <div class="order-status">


            <ul class="list-group">

                <li style="font-size:medium;" class="list-group-item">
                    <strong>Mã đơn hàng: </strong>{{$order->id}}<br>
                    <strong>Ngày đặt: </strong>{{$order->created_at}}<br>
                    <strong>Tổng tiền: </strong>{{number_format($order->price, 0, ',', '.')}}VND
                </li>
                <a style="width: 100%; background-color:beige; padding-left: 475px; color:black;"
                    href="{{route('order.detail', $order->id)}}">Chi tiết đơn
                    hàng</a>
                <button style="font-size: medium;" class="btn btn-danger">Hủy Đơn Hàng</button>
                @endforeach
            </ul>


        </div>
    </form>
</div>
@endif
@endsection