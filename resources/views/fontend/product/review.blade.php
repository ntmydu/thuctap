@extends('fontend.main')
@section('fontend-content')

<section class="container">
    <div class="row" style="width: 100%">
        <div class="col">
            <div class="form-group">


                <form action="{{route('product.review')}}" method="POST" style="width: 100%;">
                    @csrf
                    <div style=" width: 100%;" class="form-group">
                        <input hidden type="text" name="products_hidden" id="product_id" value="{{ $product->id }}">
                        <h3 style="width: 100%; margin-left: 0;" for="comment" class="form-label">Nhận Xét của bạn</h3>

                        <input hidden type="number" id="selected_rating" name="rating" required>
                        <ul class="list-inline">
                            @for($count=1; $count<=5; $count++) @php $color=($count <=$rating) ? '#ffcc00' : '#ccc' ;
                                @endphp <span id="star-{{$count}}" class="star"
                                style="cursor: pointer; color: {{ $color }}; font-size:30px;" data-index="{{$count}}"
                                data-product_id="{{$product->id}}" data-rating="{{ $rating }}" onclick="setRating(this)"
                                onmouseover="hoverRating({{ $count }})" onmouseout="resetRating()">
                                &#9733
                                </span>
                                @endfor
                        </ul>



                        <textarea style="height: 200px; font-size:medium;" name="comment" class="form-control"
                            id="comment" rows="3" placeholder="Nhập nhận xét của bạn về sản phẩm..."></textarea>
                    </div>
                    <button style="margin-left: 0;" type="submit" class="btn btn-dark">Gửi Đánh Giá</button>
                </form>
                <a href="{{route('product.detail', $product->id)}}">Quay lại</a>
            </div>
        </div>

    </div>


</section>
@endsection
<script>
function setRating(element) {
    const rating = element.getAttribute('data-index');
    document.getElementById('selected_rating').value = rating;

    // Cập nhật màu sắc sao
    for (let i = 1; i <= 5; i++) {
        const star = document.getElementById('star-' + i);
        star.style.color = (i <= rating) ? '#ffcc00' : '#ccc';
    }
}

function hoverRating(index) {
    for (let i = 1; i <= 5; i++) {
        const star = document.getElementById('star-' + i);
        star.style.color = (i <= index) ? '#ffcc00' : '#ccc';
    }
}

function resetRating() {
    const selectedRating = document.getElementById('selected_rating').value;
    for (let i = 1; i <= 5; i++) {
        const star = document.getElementById('star-' + i);
        star.style.color = (i <= selectedRating) ? '#ffcc00' : '#ccc';
    }
}
</script>

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