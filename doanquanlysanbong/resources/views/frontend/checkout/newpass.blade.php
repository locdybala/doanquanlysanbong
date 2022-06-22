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
            <div style="padding: 50px" class="col-6">
                <h2 style="font-size: 24px ; text-align: center" class="form-label mb-2">Điền mật khẩu mới</h2>
                @php
                    $token=$_GET['token'];
                    $email=$_GET['email'];
                @endphp
                <form method="post" action="{{ route('reset_newpass')}}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="customer_password" class="form-label">Điền mật khẩu mới</label>
                        <input id="customer_password" name="customer_password" type="text" class="form-control">
                        {{-- <span class="form-message">Tài khoản không chính xác !</span> --}}
                    </div>
                    @php
                    $message = Session::get('message');
                    
                    if ($message) {
                        echo '<span class="form-message">' . $message . '</span>';
                        Session::put('message', null);
                    }
                @endphp
                    <div class="authen__btns mt-4">
                        <button type="submit" class="btn btn--default">Gửi</button>

                       
                    </div>

                </form>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
@endsection
