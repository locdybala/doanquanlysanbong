@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-title">
                <h4>Thêm user</h4>
                @php
                $message=Session::get('message');
                if($message){
                    echo '<div class="alert alert-success">
                              '.$message.'
                            </div>';
                    Session::put('message', null);

                                            }
            @endphp
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action={{ route('registerAuth') }} method="post">
                        @csrf
                        <div class="form-group">
                            <label>Họ tên</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="User Name">
                        </div>
                        <div class="form-group">
                            <label>Email </label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại </label>
                            <input type="text" class="form-control" value="{{ old('phone') }}" name="phone" placeholder="Số điện thoại">
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
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /# column -->
   
    <!-- /# column -->
</div>
@endsection