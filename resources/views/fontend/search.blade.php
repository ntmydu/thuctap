@extends('fontend.main')
@section('fontend-content')
<section class="product">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Kết quả tìm kiếm cho</h1>
            </div>
        </div>
        <div class="row row-cols-4">
            @foreach($search_product as $product)
            <div class="col-3">
                <a href="{{route('product.detail', $product->id)}}">
                    <div class="shop-card">
                        <div class="card-banner img-holder" style="--width: 540 ; --height: 720;">
                            @foreach($images as $image)
                            @if($image->product_id === $product->id)
                            <img src="{{ asset($image->image_name) }}" width="100" height="100" loading="lazy"
                                class="img-product" alt="{{ $product->name }}">
                            @endif
                            @endforeach
                            <span class="badge" aria-label="20% off">-20%</span>
                            <div class="card-actions">
                                <button class="'action-btn" aria-hidden="true">
                                    <i class="lni lni-cart-1"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-content">
                            <div class="price">
                                @if($product->price_sale == 0)
                                <span class="span">{{number_format($product->price, 0, ',', '.')}}VND</span>
                                @else
                                <del class="del">{{number_format($product->price, 0, ',', '.')}}VND</del>
                                <span class="span">{{number_format($product->price_sale, 0, ',', '.')}}VND</span>
                                @endif
                            </div>
                            <h3>
                                <a href="#" class="card-title">{{$product->name}}</a>
                            </h3>
                            <div>
                                @if($product->stock <= 0) <button type="submit" class="btn btn-dark">Hết hàng</button>

                                    @else
                                    <form class="add_to-cart" action="{{route('cart.add')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_hidden" value="{{$product->id}}">
                                        <input type="number" hidden name="qty" value="1">
                                        <button type="submit"> <i class="lni lni-cart-1"></i></button>

                                    </form>
                                    @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

    </div>

</section>

@endsection