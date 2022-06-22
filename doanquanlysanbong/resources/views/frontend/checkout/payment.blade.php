@extends('frontend_layout')
@section('title')
<title>Thanh toán</title>
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/cart.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/pay.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/owlCarousel/assets/owl.theme.default.min.css') }}">
@endsection
@section('content')
    <div class="grid wide">
        <div class="row">
            <div class="col l-7 m-12 s-12">
                @php
                $content = Cart::getContent();
                
            @endphp
                <div class=" pay-information">
                    <div class="row">
                            <div class="col l-1 m-3 s-4 main__pay-text">STT</div>
                            <div class="col l-4 m-3 s-6 main__pay-text">Tên sân</div>
                            <div class="col l-2 m-2 s-0 main__pay-text">Khung giờ</div>
                            <div class="col l-2 m-1 s-0 main__pay-text">Ngày sử dụng</div>
                            <div class="col l-2 m-2 s-2 main__pay-text">Gía tiền</div>
                            <div class="main__pay-text col l-1 m-1 s-0">Xóa</div>
                        </div>
                        <div style="margin-top:20px" class="row">
                            @foreach ($content as $v_content)
                            <div class="main__pay-text col l-1 m-3 s-4">
                                1
                            </div>
                            <div class="col l-4 m-3 s-6">
                                <div class="main__cart-product">
                                    <img src="upload/pitch/{{ $v_content->attributes->image }}" alt="">
                                    <div class="name">{{ $v_content->name }}</div>
                                </div>
                            </div>
                            <div class=" col l-2 m-2 s-0">
                                <div class="main__cart-price">{{ $v_content->attributes->timeframe }}</div>
                            </div>
                            <div class="col l-2 m-1 s-0">
                                <div class="main__cart-price">{{ $v_content->attributes->ngaydat }}</div>

                            </div>
                            <div class="col l-2 m-2 s-2">
                                <div class="main__cart-price"> {{ number_format($v_content->price) }}</div>
                            </div>
                            <div class="col l-1 m-1 s-0">
                                <a href="{{ route('deletecart') }}">
                                    <span class="main__cart-icon">
                                        <i class="far fa-times-circle "></i>
                                    </span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                  

                </div>
            </div>
            <div class="col l-5 m-12 s-12">
            <div class="pay-order">
                <div class="pay__heading">Đơn hàng của bạn</div>
                <form action="{{ route('order_place') }}" method="post">
                    @csrf
                <div class="pay-info">
                    <div class="main__pay-text special">
                        Thành tiền</div>
                    <div class="main__pay-price">
                        {{number_format(Cart::getTotal(0,',','.')).' '.'vnđ' }}
                    </div>
                </div>
                <div class="pay-info">
            
                    <div class="main__pay-text">
                        Chọn hình thức thanh toán </div>
                   
                    <div class="main__pay-price">
                        <select class="form-control" name="payment_option" value="">
                            <option name="payment_option" value="1" id="">Thanh toán trực tiếp</option>
                            <option name="payment_option" value="2" id="">Thanh toán online</option>

                        </select>
                    </div>
                </div>
                
                <button type="submit" class="btn btn--default">Đặt hàng</button >
            </form>
            </div>

        </div>
        </div>
    </div>
@endsection
