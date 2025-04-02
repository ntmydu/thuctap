@extends('fontend.main')
@section('fontend-content')
<section id="cart_items">
    @if(is_array(session('cart')) && count(session('cart')) > 0)
    <div class="container">
        <!-- <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div> -->
        <div class="row">
            <div class="col-6">
                <h1>GIỎ HÀNG CỦA BẠN</h1>
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
                            <form action="{{ route('cart.update', $id) }}" method="POST" style="display:inline;">
                                @csrf
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_down" href="{{ route('cart.minus', $id) }}">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path
                                                d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z" />
                                        </svg>
                                    </a>
                                    <input class="cart_quantity_input" type="text" name="quantity"
                                        value="{{$product['quantity']}}" min="1" onchange="this.form.submit()"
                                        autocomplete="off" size="2" style="border: 1px solid">
                                    <a class="cart_quantity_up" href="{{ route('cart.plus', $id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path
                                                d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                                        </svg>
                                    </a>
                                </div>
                            </form>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($product['price'] * $product['quantity'])}}đ</p>
                        </td>
                        <td class="cart_delete">
                            <form action="{{ route('cart.destroy', $id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width: 25px">
                                        <path
                                            d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif


                </tbody>
                <tfoot>
                    <tr>
                        @if(session('discountAmounts'))
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong
                                style="font-size: medium;">-{{ number_format(session('discountAmounts.discountAmount')) }}</strong>
                        </td>
                        <td></td>

                        @endif
                    </tr>
                    <tr>
                        <form action="{{route('order')}}">
                            @csrf
                            <td colspan="3" class="font-weight-bold">Tổng Cộng</td>
                            <td class="font-weight-bold">{{number_format($totalAmount)}}đ</td>
                            <input type="number" name="totalAmount" value="{{$totalAmount}}" hidden>
                            <td><button class="btn btn-dark" type="submit"> Thanh Toán</button></td>
                        </form>

                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="row">
            <form action="{{route('discount.apply')}}" method="POST">
                @csrf
                <div id="dis" class="form-group">
                    <label class="discount-lab" for="note">Mã giảm giá:</label>
                    <input class="discount" name="discount_code" type="text" class="form-control"
                        placeholder="Nhập mã giảm giá">
                    <button class="btn btn-dark" type="submit">Áp dụng</button>
                </div>
            </form>
        </div>
    </div>
    @else
    <div class="container">
        <div class="row">
            <div class="col">GIỎ HÀNG TRỐNG</div>
        </div>
    </div>
    @endif
</section>
<!--/#cart_items-->


@endsection
<script src="theme/js/jquery.js"></script>
<script src="theme/js/bootstrap.min.js"></script>
<script src="theme/js/jquery.scrollUp.min.js"></script>
<script src="theme/js/jquery.prettyPhoto.js"></script>
<script src="theme/js/main.js"></script>