@extends('frontend_layout')
@section('title')
    <title>Xem đơn hàng</title>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/assets/owlCarousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/cart.css') }}">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
@endsection
@section('content')
    <div class="grid wide">
        <h3 class="main__notify">
            <div class="main__notify-icon">
                @php
                    $success = Session::get('success');
                    
                    if ($success) {
                        echo '<i class="fas fa-check"></i> <div class="main__notify-text">
                                                      ' .
                            $success .
                            '
                                                    </div>';
                        Session::put('success', null);
                    }
                @endphp

                @php
                    $message = Session::get('message');
                    
                    if ($message) {
                        echo '<i class="fas fa-times" style="color: red"></i> <div style="color: red" class="main__notify-text">
                                                      ' .
                            $message .
                            '
                                                    </div>';
                        Session::put('message', null);
                    }
                @endphp
            </div>



        </h3>
        @php
            $content = Cart::getContent();
        @endphp
        <div class="row">

            <div class="col l-8 m-12 s-12">
                <div class="main__cart">
                    <div class="row title">
                        <div class="col l-1 m-3 s-4">STT</div>
                        <div class="col l-4 m-3 s-6">Tên sân</div>
                        <div class="col l-2 m-2 s-0">Khung giờ</div>
                        <div class="col l-2 m-1 s-0">Ngày sử dụng</div>
                        <div class="col l-2 m-2 s-2">Gía tiền</div>
                        <div class="col l-1 m-1 s-0">Xóa</div>
                    </div>
                    @foreach ($content as $v_content)
                        <div class="row item">

                            <div class="col l-1 m-3 s-4">
                                1
                            </div>
                            <div class="col l-4 m-3 s-6">
                                <div class="main__cart-product">
                                    <img src="upload/pitch/{{ $v_content->attributes->image }}" alt="">
                                    <div class="name">{{ $v_content->name }}</div>
                                </div>
                            </div>
                            <div class="col l-2 m-2 s-0">
                                <div class="main__cart-price">{{ $v_content->attributes->timeframe }}</div>
                            </div>
                            <div class="col l-2 m-1 s-0">
                                <div class="main__cart-price">{{ $v_content->attributes->ngaydat }}</div>

                            </div>
                            <div class="col l-2 m-2 s-2">
                                <div class="main__cart-price"> {{ number_format($v_content->price) }}</div>
                            </div>
                            <div class="col l-1 m-1 s-0">
                                <form method="post" action="{{ route('deletecart') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $v_content->id }}" name="id">
                                    <span class="main__cart-icon">
                                        <button type="submit"><i class="far fa-times-circle "></i></button>
                                    </span>
                                    </a>
                                </form>
                            </div>


                        </div>

                        {{-- <div class="btn btn--default">
                    Cập nhật giỏ hàng
                </div> --}}
                </div>
                @endforeach
            </div>
            @foreach ($content as $v_content)
                @if ($v_content->name != null)
                    <div class="col l-4 m-12 s-12">
                        <div class="main__pay">
                            <div class="main__pay-title">Tổng tiền</div>
                            <div class="pay-info">
                                <div class="main__pay-text">
                                    Tiền sân</div>
                                <div class="main__pay-price">
                                    @php
                                        $total = Cart::getTotal(0, ',', '.');
                                    @endphp
                                    {{ number_format($total) . ' ' . 'vnđ' }}
                                </div>
                            </div>
                            @if (Session::get('coupon'))
                                @foreach (Session::get('coupon') as $key)
                                    @if ($key['coupon_condition'] == 1)
                                        <div class="pay-info">
                                            <div class="main__pay-text">
                                                Mã giảm</div>
                                            <div class="main__pay-price">


                                                {{ $key['coupon_number'] }} %

                                            </div>

                                        </div>
                                    @endif
                                    <div class="pay-info">

                                        <div class="main__pay-text">
                                            Số tiền giảm</div>
                                        <div class="main__pay-price">
                                            @if ($key['coupon_condition'] == 1)
                                                @php
                                                    $total_coupon = ($total * $key['coupon_number']) / 100;
                                                @endphp
                                                {{ number_format(($total * $key['coupon_number']) / 100) }} vnđ
                                            @else
                                                @php
                                                    $total_coupon = $key['coupon_number'];
                                                @endphp
                                                {{ number_format($key['coupon_number']) }} vnđ
                                            @endif
                                        </div>
                                    </div>
                                    <div class="pay-info">
                                        <div class="main__pay-text">
                                            Tổng thành tiền</div>
                                        <div name="" class="main__pay-price">

                                            {{ number_format($total - $total_coupon) }} vnđ

                                        </div>
                                    </div>
                                @endforeach
                            @endif


                            <?php
                $customer_id=Session::get('customer_id');
                if($customer_id!=  NULL){
                
            ?>
                            <a href="{{ route('checkout') }}" class="btn btn--default orange">Thanh toán</a>


                            <?php
                }else {
                    
            ?>
                            <a class="btn btn--default orange" href="{{ route('login_checkout') }}">Tiến hành thanh
                                toán</a>


                            <?php }?>
                            <form method="POST" action="{{ route('check_coupon') }}">
                                @csrf
                                <div class="main__pay-title">Phiếu ưu đãi</div>
                                <input type="text" name="coupon" class="form-control">
                                <button type="submit" name="check_coupon" class="btn btn--default">Áp dụng</button>
                            </form>
                            @if (Session::get('coupon'))
                                @csrf
                                <a href="{{ route('delete_coupon') }}" class="btn btn--default">Xóa mã khuyến mãi</a>
                            @endif

                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
@section('javascrip')
@endsection
