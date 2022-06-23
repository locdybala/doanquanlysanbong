@extends('frontend_layout')
@section('title')
    <title>Thanh toán</title>
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/pay.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/cart.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/owlCarousel/assets/owl.theme.default.min.css') }}">
@endsection
@section('content')
    <div class="grid wide">
        <div class="row">
            <div class="col l-5 m-12 s-12">
                <div class="pay-information">
                    <form method="post">
                        @csrf
                        <div class="pay__heading">Thông tin thanh toán</div>
                        <div class="form-group">
                            <label for="shipping_name" class="form-label">Họ Tên *</label>
                            <input id="shipping_name" name="shipping_name" type="text" class="shipping_name form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="shipping_address" class="form-label">Địa chỉ *</label>
                            <input id="shipping_address" name="shipping_address" type="text"
                                class="shipping_address form-control">
                            <span class="form-message"></span>
                        </div>

                        <div class="form-group">
                            <label for="shipping_email" class="form-label">Email *</label>
                            <input id="shipping_email" name="shipping_email" type="text"
                                class="shipping_email form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="shipping_phone" class="form-label">Số điện thoại *</label>
                            <input id="shipping_phone" name="shipping_phone" type="text"
                                class="shipping_phone form-control">
                            <span class="form-message"></span>
                        </div>
                        <div class="form-group">
                            <label for="shipping_notes" class="form-label">Ghi chú cho đơn hàng</label>
                            <textarea class="shipping_notes form-control" name="shipping_notes" id="shipping_notes" cols="30" rows="20"></textarea>
                        </div>
                        @if (Session::get('coupon'))
                            @foreach (Session::get('coupon') as $key)
                                <input type="hidden" value="{{ $key['coupon_code'] }}" name="order_coupon" value=""
                                    class="order_coupon">
                            @endforeach
                        @else
                            <input type="hidden" value="no" name="order_coupon" value="" class="order_coupon">
                        @endif
                        <div class="form-group">
                            <select class="form-control payment_option" name="payment_option" value="">
                                <option value="1" id="">Thanh toán trực tiếp</option>
                                <option value="2" id="">Thanh toán online</option>
                            </select>
                        </div>
                        <button type="button" style="margin-top: 10px" name="send_order"
                            class="send_order btn btn--default orange">Đặt hàng</button>
                    </form>

                </div>
            </div>
            <div class="col l-7 m-12 s-12">
                @php
                    $content = Cart::getContent();
                    
                @endphp
                <div class=" pay-information">
                    <div class="pay__heading">Xem lại đơn hàng</div>

                    <div class="row">
                        <div style="font-size: 17px;" class="col l-1 m-3 s-4 main__pay-text">STT</div>
                        <div style="font-size: 17px;" class="col l-4 m-3 s-6 main__pay-text">Tên sân</div>
                        <div style="font-size: 17px;" class="col l-2 m-2 s-0 main__pay-text">Khung giờ</div>
                        <div style="font-size: 17px;" class="col l-2 m-1 s-0 main__pay-text">Ngày sử dụng</div>
                        <div style="font-size: 17px;" class="col l-2 m-2 s-2 main__pay-text">Gía tiền</div>
                        <div style="font-size: 17px;" class="main__pay-text col l-1 m-1 s-0">Xóa</div>
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
              
                @foreach ($content as $v_content)
                    @if ($v_content->name != null)
                        <div class="col l-6 m-12 s-12">
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



                                <form method="POST" action="{{ route('check_coupon') }}">
                                    @csrf
                                    <div class="main__pay-title">Phiếu ưu đãi</div>
                                    <input type="text" name="coupon" class="form-control">
                                    <button type="submit" name="check_coupon" class="btn btn--default">Áp dụng</button>
                                </form>
                                @if (Session::get('coupon'))
                                    @csrf
                                    <a href="{{ route('delete_couponcheckout') }}" class="btn btn--default">Xóa mã khuyến
                                        mãi</a>
                                @endif

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    {{-- <div class="grid wide">
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
    </div> --}}
@endsection

@section('javascrip')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.send_order').click(function() {
                swal({
                        title: "Xác nhận đơn hàng",
                        text: "Nếu đã đặt sân, thì không thể hủy, bạn có muốn đặt không",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Đặt sân",
                        cancelButtonText: "Đóng",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            var shipping_name=$('.shipping_name').val();
                var shipping_address=$('.shipping_address').val();
                var shipping_email=$('.shipping_email').val();
                var shipping_phone=$('.shipping_phone').val();
                var shipping_notes=$('.shipping_notes').val();
                var shipping_method=$('.payment_option').val();

                var order_coupon=$('.order_coupon').val();
                var _token=$('input[name="_token"]').val();
                swal("Thành công", "Bạn đã đặt sân thành công hãy đến đúng giờ", "success");
                $.ajax({
                    url: '{{ url('/confirm_order') }}',
                    method:'POST',
                    data: {
                        shipping_name:shipping_name,
                        shipping_address:shipping_address,
                        shipping_email:shipping_email,
                        shipping_phone:shipping_phone,
                        shipping_notes:shipping_notes,
                        order_coupon:order_coupon,
                        _token:_token,
                        shipping_method:shipping_method
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data) {
                            window.location.replace(data);
                        }
                    }
                });
                window.setTimeout(() => {
                    location.reload();
                }, 3000);
                        } else {
                            swal("Đóng", "Bạn chưa đặt sân)", "error");
                        }
                    });
               


            });
        });
    </script>
@endsection
