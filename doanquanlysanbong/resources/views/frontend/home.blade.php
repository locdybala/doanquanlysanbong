@extends('frontend_layout')
@section('title')
    <title>Trang chủ</title>
@endsection
@section('style')
    <link href="{{ asset('frontend/assets/css/home.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <!-- Slider -->
    <div class="main__slice">
        <div class="slider">
            @foreach ($slider as $slider)
                <div class="slide active" style="background-image: url(/upload/slider/{{ $slider->slider_image }})">
                    <div class="container">
                        <div class="caption">
                            <h1>{{ $slider->slider_name }}</h1>
                            <p>{!! $slider->slider_description !!}</p>
                            <a href="listProduct.html" class="btn btn--default">Xem ngay</a>

                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <!-- controls  -->
        <div class="controls">
            <div class="prev">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="next">
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
        <!-- indicators -->
        <div class="indicator">
        </div>
    </div>
    <!--Product Category -->
    <div class="main__tabnine">
        <div class="grid wide">
            <!-- Tab items -->
            <div class="tabs">
                @foreach ($category as $category)
                    @if ($category->id == 1)
                        <div class="tab-item active">
                            {{ $category->name }}
                        </div>
                    @else
                        <div class="tab-item ">
                            {{ $category->name }}
                        </div>
                    @endif
                @endforeach


                <div class="line"></div>
            </div>
            <!-- Tab content -->
            <div class="tab-content">

                <div class="tab-pane active">
                    <div class="row">
                        @foreach ($pitchs as $pitch)
                            @if ($pitch->idCategory == 1)
                                <div class="col l-3 m-4 s-6">

                                    <div class="product">
                                        <div class="product__avt"
                                            style="background-image: url(upload/pitch/{{ $pitch->image }});">
                                        </div>
                                        <div class="product__info">
                                            <h3 class="product__name">{{ $pitch->name }}</h3>

                                        </div>
                                        <a href="{{ route('viewDetail', ['id' => $pitch->id]) }}" class="viewDetail">Xem chi tiết</a>
                                        {{-- <a href="cart.html" class="addToCart">Thêm vào giỏ</a> --}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane ">
                    <div class="row">
                        @foreach ($pitchs as $pitch)
                            @if ($pitch->idCategory == 2)
                                <div class="col l-3 m-4 s-6">

                                    <div class="product">
                                        <div class="product__avt"
                                            style="background-image:url(upload/pitch/{{ $pitch->image }});">
                                        </div>
                                        <div class="product__info">
                                            <h3 class="product__name">{{ $pitch->name }}</h3>

                                        </div>
                                        <a href="{{ route('viewDetail', ['id' => $pitch->id]) }}" class="viewDetail">Xem chi tiết</a>
                                        {{-- <a href="cart.html" class="addToCart">Thêm vào giỏ</a> --}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane ">
                    <div class="row">
                        @foreach ($pitchs as $pitch)
                            @if ($pitch->idCategory == 3)
                                <div class="col l-3 m-4 s-6">

                                    <div class="product">
                                        <div class="product__avt"
                                            style="background-image: url(upload/pitch/{{ $pitch->image }});">
                                        </div>
                                        <div class="product__info">
                                            <h3 class="product__name">{{ $pitch->name }}</h3>

                                        </div>
                                        <a href="{{ route('viewDetail', ['id' => $pitch->id]) }}" class="viewDetail">Xem chi tiết</a>
                                        {{-- <a href="cart.html" class="addToCart">Thêm vào giỏ</a> --}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
                <div class="tab-pane ">
                    <div class="row">
                        @foreach ($pitchs as $pitch)
                            @if ($pitch->idCategory == 4)
                                <div class="col l-3 m-4 s-6">

                                    <div class="product">
                                        <div class="product__avt"
                                            style="background-image: url(upload/pitch/{{ $pitch->image }});">
                                        </div>
                                        <div class="product__info">
                                            <h3 class="product__name">{{ $pitch->name }}</h3>

                                        </div>
                                        <a href="{{ route('viewDetail', ['id' => $pitch->id]) }}" class="viewDetail">Xem chi tiết</a>
                                        {{-- <a href="cart.html" class="addToCart">Thêm vào giỏ</a> --}}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- HightLight  -->
        <div class="main__frame">
            <div class="grid wide">
                <h3 class="category__title"></h3>
                <h3 class="category__heading">DANH SÁCH CÁC SÂN</h3>

                <div class="owl-carousel hight owl-theme">
                    @foreach ($pitchs as $pitch)
                        <div class="product">
                            <div class="product__avt" style="background-image: url(upload/pitch/{{ $pitch->image }});">
                            </div>
                            <div class="product__info">
                                <h3 class="product__name">{{ $pitch->name }}</h3>


                            </div>
                            <a href="{{ route('viewDetail', ['id' => $pitch->id]) }}" class="viewDetail">Xem chi
                                tiết</a>
                            {{-- <a href="cart.html" class="addToCart">Thêm vào giỏ</a> --}}
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- Sales Policy -->
        <div class="main__policy">
            <div class="row">
                <div class="col l-3 m-6">
                    <div class="policy bg-1">
                        <img src="frontend/assets/img/policy/policy1.png" class="policy__img">
                        <div class="policy__info">
                            <h3 class="policy__title">SÂN BÓNG ĐỦ TIÊU CHUẨN</h3>
                            <p class="policy__description">Các sân bóng được thiết kế theo đúng chuẩn thế giới yêu
                                cầu</p>
                        </div>
                    </div>
                </div>
                <div class="col l-3 m-6">
                    <div class="policy bg-2">
                        <img src="frontend/assets/img/policy/policy2.png" class="policy__img">
                        <div class="policy__info">
                            <h3 class="policy__title">ĐẶT SÂN NHANH</h3>
                            <p class="policy__description">Đặt sân nhanh chóng thuận tiện</p>
                        </div>
                    </div>
                </div>
                <div class="col l-3 m-6">
                    <div class="policy bg-1">
                        <img src="frontend/assets/img/policy/policy3.png" class="policy__img">
                        <div class="policy__info">
                            <h3 class="policy__title">CHẤT LƯỢNG</h3>
                            <p class="policy__description">Chất lượng mặt cỏ đủ tiêu chuẩn</p>
                        </div>
                    </div>
                </div>
                <div class="col l-3 m-6">
                    <div class="policy bg-2">
                        <img src="frontend/assets/img/policy/policy4.png" class="policy__img">
                        <div class="policy__info">
                            <h3 class="policy__title">TƯ VẤN 24/24</h3>
                            <p class="policy__description">Giải đáp mọi thắc mắc</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- News -->
        <div class="main__frame bg-3">
            <div class="grid wide">
                <h3 class="category__heading">Tin Tức</h3>
                <div class="owl-carousel news owl-theme">
                    @foreach ($post as $key)
                        <a href="#" class="news">
                            <div class="news__img">
                                <img src="upload/post/{{ $key->image }}" alt="">
                            </div>
                            <div class="news__body">
                                <h3 class="news__body-title">{{ $key->title }}</h3>
                                <div class="new__body-date">{{ $key->created_at }}</div>
                                <p class="news__description">
                                    {{ $key->meta_desc }}
                                </p>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="main__bands">
            <div class="grid wide">
                <div style="padding: 5px 0" class="owl-carousel bands">
                    <a href="listProduct.html" class="band__item"
                        style="background-image: url(frontend/assets/img/band/band1.png)"></a>
                    <a href="listProduct.html" class="band__item"
                        style="background-image: url(frontend/assets/img/band/band2.png)"></a>
                    <a href="listProduct.html" class="band__item"
                        style="background-image: url(frontend/assets/img/band/band3.png)"></a>
                    <a href="listProduct.html" class="band__item"
                        style="background-image: url(frontend/assets/img/band/band4.png)"></a>
                    <a href="listProduct.html" class="band__item"
                        style="background-image: url(frontend/assets/img/band/band5.png)"></a>
                    <a href="listProduct.html" class="band__item"
                        style="background-image: url(frontend/assets/img/band/band6.png)"></a>
                    <a href="listProduct.html" class="band__item"
                        style="background-image: url(frontend/assets/img/band/band9.jpg)"></a>
                </div>
            </div>
        </div>
    @endsection
    @section('javascrip')
        <script src="{{ asset('frontend/assets/js/homeScript.js') }}"></script>
    @endsection
