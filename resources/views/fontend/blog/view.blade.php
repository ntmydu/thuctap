@extends('fontend.main')

@section('fontend-content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <!-- Tên bài viết -->
            <h1 class="text-center mb-4">{{ $post->title }}</h1>
            <p class="text-muted">Tác giả: <strong>{{ $post->author }}</strong></p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Nội dung bài viết -->
            <div class="content">
                {!! $post->content !!}
            </div>
        </div>
    </div>
</div>
@endsection