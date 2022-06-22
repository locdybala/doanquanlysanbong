@extends('frontend_layout')
@section('title')
    <title>Danh mục bài viết</title>
@endsection
@section('style')
<style>
    .new-item__time{
        font-size: 14px !important;
    }
    h1{
        font-size: 21px !important;
    padding: 10px 0 !important;
    font-weight: bold !important;
    }
p{
    font-size:18px !important;
    line-height: 2.5 !important;
}img{margin-left: 400px !important;}
</style>
@endsection
@section('content')
    <div style="padding: 50px 0" class="grid wide">
        <div class="main__taskbar">
            <div class="main__breadcrumb">
                <div class="breadcrumb__item">
                    <a href="#" class="breadcrumb__link">Bài viết</a>
                </div>
                <div class="breadcrumb__item">
                    <a href="#" class="breadcrumb__link">Chi tiết tin tức</a>
                </div>
            </div>
        </div>
        <div class="list-new">
                <div href="#" class="new-item">
                    <h1 href="#" >
                        {{ $post->title }}
                    </h1>
                    {{-- <a href="#" class="new-item__img">
                        <img src="{{ asset('upload/post/'. $post->image) }}" alt="">
                    </a> --}}
                        
                        <div class="new-item__time"> Ngày đăng: {{ $post->created_at }}</div>
                        <p class="new-item__time">{!! $post->description !!}</p>
                        <p class="new-item__time">{!! $post->content !!}</p>


                </div>


        </div>
    </div>
@endsection
