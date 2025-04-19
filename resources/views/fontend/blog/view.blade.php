@extends('fontend.main')

@section('fontend-content')
<div style="background-color: rgba(254, 251, 244);" class="container mt-5">
    <div class="row">
        <div class="col-12">
            <!-- Tên bài viết -->
            <h1 class="text-center mb-4">{{ $blog->title }}</h1>
            <p class="text-muted" style="font-size: 1.8rem;">Tác giả: <strong>{{ $blog->author }}</strong></p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Nội dung bài viết -->
            <div class="content">
                {!! $blog->content !!}
            </div>
        </div>
    </div>
</div>
@endsection