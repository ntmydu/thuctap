@extends('fontend.main')
@section('fontend-content')
<section id="cart_items" class="mt-5">
    @if(is_array(session('cart')) && count(session('cart')) > 0)
    <div class="container" style="font-size: medium;">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">GIỎ HÀNG CỦA BẠN</h1>
            </div>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-bordered">
                <thead class="table">
                    <tr class="cart_menu text-center" style="color: inherit; background-color: rgba(254, 251, 244);">
                        <th class="title">Sản phẩm</th>
                        <th class="title">Giá</th>
                        <th class="title">Số lượng</th>
                        <th class="title">Tổng cộng</th>
                        <th class="title"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0  ?>
                    @if(session('cart'))
                    @foreach(session('cart') as $id => $product)
                    <tr>
                        <td class="cart_product">
                            <div class="d-flex align-items-center">
                                <a href="">
                                    <img src="{{ asset($product['image']) }}" alt="" width="70px" class="me-3">
                                </a>
                                <div>
                                    <h5 class="mb-0"><a href="">{{ $product['name'] }}</a></h5>
                                </div>
                            </div>
                        </td>
                        <td class="cart_price text-center">
                            <p>{{ number_format($product['price']) }}đ</p>
                        </td>
                        <td class="cart_quantity text-center">
                            <form action="{{ route('cart.update', $id) }}" method="POST" style="display:inline;">
                                @csrf
                                <div class="cart_quantity_button d-flex justify-content-center align-items-center">
                                    <a class="cart_quantity_down btn btn-outline-secondary btn-sm me-2"
                                        href="{{ route('cart.minus', $id) }}">
                                        -
                                    </a>
                                    <input class="cart_quantity_input text-center" type="text" name="quantity"
                                        value="{{ $product['quantity'] }}" min="1" onchange="this.form.submit()"
                                        autocomplete="off" size="2" style="width: 50px; border: 1px solid #ddd;">
                                    <a class="cart_quantity_up btn btn-outline-secondary btn-sm ms-2"
                                        href="{{ route('cart.plus', $id) }}">
                                        +
                                    </a>
                                </div>
                            </form>
                        </td>
                        <td class="cart_total text-center">
                            <p class="cart_total_price">
                                {{ number_format($product['price'] * $product['quantity'], 0, ".", ",") }}đ
                            </p>
                        </td>
                        <td class="cart_delete text-center">
                            <form action="{{ route('cart.destroy', $id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('delete')
                                <button style="width: 25px; height: 30px;" class="btn btn-danger btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
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
                        <td colspan="3" class="text-end fw-bold">Giảm giá:</td>
                        <td class="fw-bold text-center text-danger">
                            -{{ number_format(session('discountAmounts.discountAmount')) }}đ
                        </td>
                        <td></td>
                        @endif
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Tổng Cộng:</td>
                        <td class="fw-bold text-center">{{ number_format($totalAmount, 0, ".", ",") }}đ</td>
                        <td>
                            <form action="{{ route('order') }}" method="POST">
                                @csrf
                                <button class="btn btn-success w-100">Thanh Toán</button>
                            </form>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="row mt-4">
            <form action="{{ route('discount.apply') }}" method="POST"
                class="d-flex justify-content-center align-items-center">
                @csrf
                <div class="form-group me-2">
                    <input class="form-control" name="discount_code" type="text" placeholder="Nhập mã giảm giá">
                </div>
                <button style="margin-left: 20px; padding: 3px !important; font-size: 1.3rem !important;"
                    class="btn btn-dark" type="submit">Áp
                    dụng</button>
            </form>
        </div>
    </div>
    @else
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>GIỎ HÀNG TRỐNG</h2>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection