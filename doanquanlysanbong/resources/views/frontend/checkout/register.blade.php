@extends('frontend_layout')
@section('title')
    <title>Đăng ký</title>
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
            <div style="margin-top:50px; " class=" col-4">
                <h2 style="font-size: 24px ; text-align: center" class="form-label mb-2">Đăng Ký Tài khoản</h2>
                <form action="{{ route('add_customer') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="customer_name" class="form-label">Họ tên </label>
                        <input id="customer_name" name="customer_name" type="text" placeholder="Họ tên"
                            class="form-control">
                        {{-- <span class="form-message"></span> --}}
                    </div>
                    <div class="form-group  mt-2">
                        <label for="customer_email" class="form-label">Địa chỉ email </label>
                        <input id="customer_email" name="customer_email" type="email" placeholder="Địa chỉ email"
                            class="form-control">
                        {{-- <span class="form-message">Tài khoản không chính xác !</span> --}}
                    </div>

                    <div class="form-group mt-2">
                        <label for="customer_password" class="form-label">Mật khẩu </label>
                        <input id="customer_password" name="customer_password" type="password" placeholder="Mật khẩu"
                            class="form-control">
                        {{-- <span class="form-message"></span> --}}
                    </div>
                    <div class="form-group mt-2">
                        <label for="customer_phone" class="form-label">Số điện thoại </label>
                        <input id="customer_phone" name="customer_phone" type="text" placeholder="Số điện thoại"
                            class="form-control">
                        {{-- <span class="form-message"></span> --}}
                    </div>
                    <div class="form-group mt-2">
                        <label for="customer_image" class="form-label">Ảnh đại diện</label>
                        <input id="customer_image" name="customer_image" type="file" class="form-control">
                        {{-- <span class="form-message"></span> --}}
                    </div>
                    <div class="form-group mt-2">
                        <label for="customer_address" class="form-label">Địa chỉ</label>
                        <input id="customer_address" name="customer_address" placeholder="Địa chỉ" type="text"
                            class="form-control">
                        {{-- <span class="form-message"></span> --}}
                    </div>
                   

                    <div style="margin-bottom:10px" class="authen__btns mt-4">
                        <button type="submit" class="btn btn--default">Đăng Ký</button type="submit">
                        <a class="form-label " style="margin-left:20px" href="{{ route('login_checkout') }}"> Đăng
                            Nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
