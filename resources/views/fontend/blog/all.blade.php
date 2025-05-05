@extends('fontend.main')

@section('fontend-content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Bài viết mới nhất</h2>
    <div class="row text-center">
        @foreach($blogs as $blog)

        <div style="background-color: rgba(254, 251, 244); width: 100%; " class=" col col-md-4 mb-4">
            <a href="{{route('blog.detail', $blog->id)}}">
                <div style="height:300px;" class="card h-100 shadow-sm">
                    <!-- Hình ảnh bài viết -->
                    <div style="width: 350px;">

                        <img src="{{ asset('sliders/' . $blog->image) }}" style="max-height: 200px; object-fit: cover;"
                            loading="lazy" class="img-cover" alt="{{ $blog->title }}">

                    </div>
                    <div style="background-color: rgba(254, 251, 244); width: 100%; " class="card-body">
                        <!-- Tên bài viết -->
                        <h5 class="card-title">{{ $blog->title }}</h5>

                        <!-- Tên tác giả -->
                        <p class="text-muted">Tác giả: {{ $blog->author }}</p>

                        <!-- Nội dung tóm tắt -->


                        <!-- Nút xem chi tiết -->

                    </div>
                </div>
            </a>
        </div>

        @endforeach
    </div>
</div>
@endsection