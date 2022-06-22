<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Focus Admin: Widget</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

    <!-- Styles -->
    <link href="{{ asset('backend/css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/lib/themify-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/css/lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{  asset('backend/css/lib/helper.css')}}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css')}}" rel="stylesheet">
</head>

<body class="bg-primary">

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        
                        <div class="login-form">
                            <h4>Quản lý hệ thống</h4>
                            <form action="{{ route('loginAuth') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Tên đăng nhập</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                @php
                                    $message=Session::get('message');
                                    if($message){
                                        echo '<div class="alert alert-danger">
												  '.$message.'
												</div>';
                                        Session::put('message', null);

                                                                }
                                @endphp
                                <div class="checkbox">
                                    <label>
										<input type="checkbox"> Nhớ đăng nhập
									</label>
                                    <label class="pull-right">
										<a href="#">Quên mật khẩu</a>
									</label>

                                </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Đăng nhập</button>
                                <div class="social-login-content">
                                    <div class="social-button">
                                        <button type="button" class="btn btn-primary bg-facebook btn-flat btn-addon m-b-10"><i class="ti-facebook"></i>Đăng nhập bằng facebook</button>
                                        <button type="button" class="btn btn-primary bg-google btn-flat btn-addon m-t-10"><i class="ti-google"></i>Đăng nhập bằng google</button>
                                    </div>
                                </div>
                                <div class="register-link m-t-15 text-center">
                                    <p>Chưa có tài khoản ? <a href="{{ route('register_auth') }}"> Đăng ký tài khoản</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>s