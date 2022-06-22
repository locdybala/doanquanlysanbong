@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>Danh sách mã giảm giá</h4>
                @php
                                    $message=Session::get('message');
                                    
                                    if($message){
                                        echo '<div class="alert alert-danger">
												  '.$message.'
												</div>';
                                        Session::put('message', null);
                                    
                                                         }
                                @endphp

                                @php
                                     $success=Session::get('success');
                
                if($success){
                    echo '<div class="alert alert-success">
                              '.$success.'
                            </div>';
                    Session::put('success', null);}
                                @endphp
            </div>
            <div class="bootstrap-data-table-panel">
                <div class="table-responsive">
                    <table id="row-select" class="display table table-borderd table-hover">
                        <a href="{{ route('add_coupon') }}" class="btn btn-success">Thêm</a>
                        <a href="{{ route('send_coupon') }}" class="btn btn-sm btn-danger ml-2">Gửi mã giảm giá</a>

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên mã giảm giá</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Mã giảm giá</th>
                                <th>Số lượng mã</th>
                                <th>Điều kiện giảm</th>
                                <th>Số giảm</th>
                                <th>Tình trạng</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                           @foreach ($coupons as $coupon)
                               <tr>
                                <td>{{ $coupon->id }}</td>

                                   <td>{{ $coupon->coupon_name }}</td>
                                   <td>{{ $coupon->coupondate_start }}</td>
                                   <td>{{ $coupon->coupondate_end }}</td>

                                   <td>{{ $coupon->coupon_code }}</td>
                                   <td>{{ $coupon->coupon_times }}</td>
                                   @if ($coupon->coupon_condition==1)
                                   <td>Giảm theo phần trăm</td>
                                   @else
                                   <td>Giảm theo tiền</td>
                                       
                                   @endif
                                   @if ($coupon->coupon_condition==1)
                                   <td>Giảm {{ $coupon->coupon_number }}%</td>
                                   @else
                                   <td>Giảm {{ $coupon->coupon_number }} vnđ</td>
                                       
                                   @endif
                                   @if ($coupon->coupon_status==1)
                                   <td style="color:rgb(8, 185, 61)">Đang kích hoạt</td>
                                   @else
                                   <td style="color: red">Đang khóa </td>
                                       
                                   @endif
                                 
                                   @if ($coupon->coupondate_end>=$today)
                                   <td style="color:rgb(8, 185, 61)">Còn hạn</td>
                                   @else
                                   <td style="color: red">Hết hạn</td>
                                       
                                   @endif
                                   <td>
                                    <form action="#" method="POST">
                                  
                                    @csrf
                                    @method('DELETE')
                                    <a onclick="return confirm('Bạn có muốn xóa mã này không')" href="{{ route('deletecoupon',['id'=>$coupon->id]) }}"  class="btn btn-danger">Xóa</a>
                                </form>
                                </td>

                               </tr>
                           @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
        <!-- /# card -->
    </div>
  
</div>
@endsection