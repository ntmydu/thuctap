@extends('fontend.main')
@section('fontend-content')
<section class="product">
    <div class="container mt-4">
        <!-- Phần hiển thị "Tất cả sản phẩm" và lọc sản phẩm -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <!-- Mục Tất cả sản phẩm -->
                    <!-- Dropdown lọc sản phẩm theo giá -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle filterPriceDropdown" type="button"
                            id="filterPriceDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Lọc sản phẩm
                        </button>
                        <ul class="dropdown-menu filterPriceDropdownMenu" aria-labelledby="filterPriceDropdownMenu">
                            <li><a class="dropdown-item" href="{{route('product.all')}}">Tất cả sản phẩm</a></li>
                            <li><a class="dropdown-item" href="{{route('product.filterLow')}}">Dưới
                                    100.000 VND</a></li>
                            <li><a class="dropdown-item" href="{{route('product.filterAverage')}}">100.000 - 200.000
                                    VND</a></li>
                            <li><a class="dropdown-item" href="{{route('product.filterHigh')}}">200.000 - 400.000
                                    VND</a></li>
                            <li><a class="dropdown-item" href="{{route('product.filterHigher')}}">400.000 - 600.000
                                    VND</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Tất cả sản phẩm</h1>
            </div>
        </div>
        <div class="row row-cols-4">
            @foreach($products as $product)
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

<script>
const menu = document.querySelector('.filterPriceDropdownMenu')
document.querySelector('.filterPriceDropdown').addEventListener('click', function() {
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
});
</script>

@endsection