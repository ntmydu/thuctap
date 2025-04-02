@extends('fontend.main')

@section('fontend-content')

<!-- Slider -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($slides as $index => $slide)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
            class="{{ $index === 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($slides as $index => $slide)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            <div class="item-wrap">
                <div class="content">
                    <div class="heading">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, neque.</div>
                    <div class="desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, repellat!</div>
                    <button class="button">Mua ngay</button>
                </div>

                <div class="image">
                    <img class="d-block w-100" src="{{ asset('sliders/' . $slide->image) }}"
                        alt="Slide {{ $index + 1 }}" style="object-fit: cover">
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<section class="section shop" id="shop" aria-label="shop" data-section>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="title-wrapper">
                    <h2 class="h2 section-title">Bán chạy nhất</h2>
                    <a href="#" class="btn-link">
                        <span class="span">Tất cả sản phẩm</span>
                        <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                        <i class="lni lni-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($products as $product)
            <a href="{{route('product.detail', $product->id)}}">
                <div class="col">
                    <div class="shop-card">
                        <div class="card-banner img-holder" style="--width: 540 ; --height: 720;">

                            @foreach($images as $image)
                            @if($image->product_id === $product->id)
                            <img src="{{ asset($image->image_name) }}" width="100" height="100" loading="lazy"
                                class="img-cover" alt="{{ $product->name }}">
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
                                <del class="del">{{number_format($product->price, 0, ',', '.')}}đ</del>
                                <span class="span">{{number_format($product->price_sale, 0, ',', '.')}}đ</span>
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
                                        <div style="display: flex; gap: 10px">
                                            <input type="number" hidden name="qty" value="1">
                                            <button type="submit">
                                                <i class="zmdi zmdi-shopping-cart" style="font-size: 3rem;"></i>
                                            </button>
                                        </div>

                                    </form>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach

        </div>




    </div>
</section>

<!-- BANNER -->
<section class="section banner" aria-label="banner" data-section="">
    <div class="container">
        <a href="#">
            <img src="{{asset('sliders/banner1.jpg')}}" alt="Ảnh" class="image-banner">
        </a>
    </div>

</section>




@endsection