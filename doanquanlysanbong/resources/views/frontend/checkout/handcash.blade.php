@extends('frontend_layout')
@section('title')
<title>Đơn hàng</title>
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
               
                <div class="main__pay-text pay-information">
                   
                  Bạn đã đặt sân thành công, hy vọng bạn sẽ tới đúng giờ

                </div>
            </div>
           
        </div>
    </div>
@endsection
