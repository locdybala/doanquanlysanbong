@extends('frontend_layout')
@section('title')
<title>Đăng nhập</title>
@endsection
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="image col-8 mb-5 mt-5">
                <img style="width:100%; "
                    src="https://img4.thuthuatphanmem.vn/uploads/2020/12/25/anh-bong-da-dep_105530596.jpg" alt="">
            </div>
            <div style="margin-top:150px; " class=" col-4">
                <h2 style="font-size: 24px ; text-align: center" class="form-label mb-2">Đăng nhập</h2>
                <form method="post" action="{{ route('login_customer')}}">
                    @csrf

                    <div class="form-group">
                        <label for="customer_email" class="form-label">Địa chỉ email *</label>
                        <input id="customer_email" name="customer_email" type="text" class="form-control">
                        {{-- <span class="form-message">Tài khoản không chính xác !</span> --}}
                    </div>
                    <div class="form-group mt-4">
                        <label for="customer_password" class="form-label">Mật khẩu *</label>
                        <input id="customer_password" name="customer_password" type="password" class="form-control">
                        @php
                            $message = Session::get('message');
                            
                            if ($message) {
                                echo '<span class="form-message">' . $message . '</span>';
                                Session::put('message', null);
                            }
                            $success = Session::get('success');
                            
                            if ($success) {
                                echo '<span class="form-success">' . $success . '</span>';
                                Session::put('success', null);
                            }
                        @endphp
                    </div>
                    <div class="authen__btns mt-4">
                        <button type="submit" class="btn btn--default">Đăng Nhập</button>

                        <a class="form-label " style="margin:0 20px" href="{{ route('register') }}"> Đăng ký</a>
                        <a style="padding-bottom: 15px; color:blue;" href="{{ route('quenmatkhau') }}" class="authen__link">Quên mật khẩu ?</a>
                    </div>
                    <a href="{{ route('login_customer_google') }}"><img style="width:50px"  src="{{ asset('frontend/assets/img/gg.png') }}" alt="Đăng nhập bằng tài khoản google"></a>
                    <a href=""><img style="width:42px"  src="{{ asset('frontend/assets/img/fb.png') }}" alt="Đăng nhập bằng tài khoản google"></a>
                    
                   
                </form>
            </div>
        </div>
    </div>
@endsection
