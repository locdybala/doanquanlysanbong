@extends('frontend_layout')
@section('title')
    <title>Danh mục bài viết</title>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/new.css') }}">
    <style>
        strong{
            font-size: 17px !important;
        }
        p{
            font-size: 17px !important;
        }
    </style>
@endsection
@section('content')
    <div class="grid wide">
        <div class="main__taskbar">
            <div class="main__breadcrumb">
                <div class="breadcrumb__item">
                    <a href="#" class="breadcrumb__link">Bài viết</a>
                </div>
                <div class="breadcrumb__item">
                    <a href="#" class="breadcrumb__link">{{ $catename }}</a>
                </div>
            </div>
        </div>
        <div class="list-new">
            @foreach ($post as $post)
                <div href="#" class="new-item">
                    <a href="#" class="new-item__img">
                        <img src="{{ asset('upload/post/' . $post->image) }}" alt="">
                    </a>
                    <div class="new-item__body">
                        <a href="#" class="new-item__title">
                            {{ $post->title }}
                        </a>
                        <div class="new-item__time"> Ngày đăng: {{ $post->created_at }}</div>
                        <p class="new-item__time">{!! $post->description !!}</p>

                        <a style="margin-top:10px;" href="{{ route('baiviet',['slug'=>$post->slug]) }}" class="btn btn--default">Xem thêm</a>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endsection
