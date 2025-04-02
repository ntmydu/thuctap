@extends('fontend.main')
@section('fontend-content')

<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="small-container single-product">
        <div class="row">
            <div class="col-6">
                <ul>
                    @foreach($images as $index => $image)
                    <!-- Giả sử $images là mảng các hình ảnh -->
                    <!-- Kiểm tra ID sản phẩm -->
                    @if($image->product_id === $product->id && $index === 0)
                    <li>
                        <img src="{{ asset($image->image_name)}}" alt="{{ $product->name }}" style="width: 100%"
                            id="product-img" class="product-img">
                        <div class="list-thumbs-footer">
                            <div class="row">
                                @foreach($images as $indexInner => $image)
                                <div class="col">
                                    <img src="{{ asset($image->image_name)}}" alt="{{ $product->name }}"
                                        style="width: 100px" class="product-img-thumb" id="product-img-thumb"
                                        onclick="handleChangeImage('{{ asset($image->image_name)}}')">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>


            <div class="col-6" style="margin-bottom: 160px;">
                <div>
                    <h2 class="title">{{$product->name}}</h2>
                </div>

                <p class="price">{{number_format($product->price_sale, 0, ',', '.')}}đ</p>
                <div>
                    @if($product->stock <= 0) <button class="btn btn-dark" type="submit">Hết hàng</button>
                        @else
                        <form class="add_to-cart" action="{{route('cart.add')}}" method="POST">
                            @csrf
                            <div class="select">

                                <input type="hidden" name="product_hidden" value="{{$product->id}}">


                                <button class="btn btn-dark" type="submit">Thêm vào giỏ hàng</button>
                            </div>
                        </form>
                        @endif
                </div>

                <div>
                    <h4 class="sub-title">Mô tả sản phẩm</h4>
                    <p class="description">4</p>
                </div>

                <div class="mt-4 line">
                    <h5 class="sub-title">Thông tin bổ sung</h5>
                    <ul class="list-inline">
                        <li class="list-inline-item"><i class="lni lni-check-circle-1"></i> Không chứa cồn</li>
                        <li class="list-inline-item"><i class="lni lni-check-circle-1"></i> Không sulfate</li>
                        <li class="list-inline-item"><i class="lni lni-check-circle-1"></i> Không dầu khoáng</li>
                        <li class="list-inline-item"><i class="lni lni-check-circle-1"></i> Không paraben</li>
                    </ul>
                </div>

                <div class="mt-4">
                    <h5 class="sub-title">Thích hợp với</h5>
                    <p class="description">Mọi loại da</p>
                </div>

                <div class="mt-4">
                    <h5 class="sub-title">Thành phần chính</h5>
                    <p class="description">Với tinh bột nghệ, Yến mạch và Vitamin B3</p>
                </div>

            </div>

        </div>
        <!-- <div style="width: 100%" class="row">
            @if(Auth::check())
            <form style="width: 100%" id="reviewForm">
                <input type="hidden" id="product_id" value="{{ $product->id }}">
                <div style="align-items: center; " class="form-group">
                    <h2 style="justify-content: center;" class="form-label">Đánh Giá Sản Phẩm</h2>
                    <ul class="list-inline">
                        @for($count=1; $count<=5; $count++) <li class="rating"
                            style="cursor:pointer; color: #ccc; font-size: 30px;">&#9733</li>
                            @endfor
                    </ul>
                    <input type="hidden" id="selected_rating" name="rating" required>
                </div>
                <div class="">
                    <h3 for="comment" class="form-label">Nhận Xét</h3>
                    <textarea style="height: 200px; font-size:medium;" class="form-control" id="comment" rows="3"
                        placeholder="Nhập nhận xét của bạn về sản phẩm..."></textarea>
                </div>
                <button style="margin-left: 0;" type="submit" class="btn btn-dark">Gửi Đánh Giá</button>

            </form>
            @else
            <span style="font-size: 1.5rem;">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đánh giá sản
                phẩm.</span>
            @endif

        </div> -->

    </div>


</section>
@endsection
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const productId = $('#product_id').val();

    function fetchReviews() {
        $.get(`/reviews/${productId}`, function(data) {
            let reviewsHtml = '';
            data.forEach(review => {
                reviewsHtml += `<div class="border p-3 mb-3">
                        <strong>Đánh Giá: ${review.rating}</strong>
                        <p>${review.comment}</p>
                    </div>`;
            });
            $('#reviewsList').html(reviewsHtml);
        });
    }

    $('#rating .star').on('click', function() {
        const rating = $(this).data('value');
        $('#selected_rating').val(rating);
        $('#rating .star').removeClass('fas fa-star').addClass('far fa-star');
        $(this).prevAll().addBack().addClass('fas fa-star').removeClass('far fa-star');
    });

    $('#reviewForm').on('submit', function(e) {
        e.preventDefault();

        const formData = {
            product_id: productId,
            rating: $('#selected_rating').val(),
            comment: $('#comment').val(),
        };

        $.post('/reviews', formData, function(response) {
            alert('Đánh giá thành công!');
            $('#reviewForm')[0].reset();
            $('#rating .star').removeClass('fas fa-star').addClass('far fa-star');
            fetchReviews();
        }).fail(function(error) {
            alert('Có lỗi xảy ra: ' + error.responseJSON.error);
        });
    });

    fetchReviews();
});
</script> -->
<script>
    const handleChangeImage = (urlImg) => {
        document.getElementById('product-img').src = urlImg;

        const thumbs = document.getElementsByClassName('product-img-thumb');

        // Lặp qua tất cả thumbnail để thêm hoặc xóa class 'active'
        for (let i = 0; i < thumbs.length; i++) {
            if (thumbs[i].src === urlImg) {
                thumbs[i].style.border = '1px solid'; // Thêm border cho thumbnail đã nhấn
            } else {
                thumbs[i].style.border = 'none'; // Xóa border cho thumbnail không phải là thumbnail đã nhấn
            }
        }
    }

    window.onload = function() {
        const thumbs = document.getElementsByClassName('product-img-thumb');
        if (thumbs.length > 0) {
            // Lấy nguồn của thumbnail đầu tiên
            const firstThumb = thumbs[0].src;
            handleChangeImage(firstThumb); // Đặt ảnh chính là thumbnail đầu tiên
            thumbs[0].style.border = '1px solid'; // Thêm border cho thumbnail đầu tiên
        }
    }
</script>