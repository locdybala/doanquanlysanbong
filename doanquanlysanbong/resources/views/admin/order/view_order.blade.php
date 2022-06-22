@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Thông tin người đặt</h4>
                    @php
                        $message = Session::get('message');
                        
                        if ($message) {
                            echo '<div class="alert alert-danger">
                ' .
                                $message .
                                '
                </div>';
                            Session::put('message', null);
                        }
                    @endphp

                    @php
                        $success = Session::get('success');
                        
                        if ($success) {
                            echo '<div class="alert alert-success">
                                  ' .
                                $success .
                                '
                                </div>';
                            Session::put('success', null);
                        }
                    @endphp
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table id="row-select" class="display table table-borderd table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Khách Hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Ghi chú</th>
                                    <th>Hình thức thanh toán</th>


                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{ $shipping->shipping_name }}</td>
                                    <td>{{ $shipping->shipping_phone }}</td>
                                    <td>{{ $shipping->shipping_address }}</td>
                                    <td>{{ $shipping->shipping_email }}</td>
                                    <td>{{ $shipping->shipping_notes }}</td>
                                    <td>
                                        @if ($shipping->shipping_method == 1)
                                            Thanh toán online
                                        @else
                                            Tiền mặt
                                        @endif
                                    </td>

                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>
        <!-- /# column -->

        <!-- /# column -->
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách đặt sân</h4>
                    @php
                        $message = Session::get('message');
                        
                        if ($message) {
                            echo '<div class="alert alert-danger">
                ' .
                                $message .
                                '
                </div>';
                            Session::put('message', null);
                        }
                    @endphp

                    @php
                        $success = Session::get('success');
                        
                        if ($success) {
                            echo '<div class="alert alert-success">
                                  ' .
                                $success .
                                '
                                </div>';
                            Session::put('success', null);
                        }
                    @endphp
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table style="text-align: center" id="row-select" class="display table table-borderd table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Mã giảm giá</th>
                                    <th>Khung giờ</th>
                                    <th>Ngày sử dụng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i = 1;
                                    
                                    $total = 0;
                                @endphp


                                @foreach ($order_details as $orderdetails)
                                    <tr>
                                        @php
                                            $subtotal = $orderdetails->pitch_price;
                                            $total += $subtotal;
                                        @endphp
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $orderdetails->pitch_name }}</td>
                                        <td>
                                            @if ($orderdetails->pitch_coupon != 'no')
                                                {{ $orderdetails->pitch_coupon }}
                                            @else
                                                Không có mã
                                            @endif
                                        </td>
                                        <td>{{ $orderdetails->pitch_timeframe }}</td>
                                        <td>{{ $orderdetails->pitch_date }}</td>
                                        <td>{{ number_format($orderdetails->pitch_price) }}</td>
                                @endforeach
                                </tr>



                            </tbody>

                           

                        </table>
                        <td colspan="2">
                            Tổng tiền :{{ number_format($total) }} vnđ
                            <br>
                            @php
                                $total_coupon = 0;
                            @endphp
                            @if ($coupon_condition == 1)
                                @php
                                    
                                    $total_aftercoupon = ($total * $coupon_number) / 100;
                                    $total_coupon = $total - $total_aftercoupon;
                                @endphp
                            @else
                                @php
                                    echo 'Tổng giảm:' . $coupon_number . 'vnđ';
                                    $total_coupon = $total - $coupon_number;
                                @endphp
                            @endif
                            <br>
                            Thành tiền {{ number_format($total_coupon) }} vnđ
                        </td>
                        
                       @foreach ($order as $order)
                           
                        <div class="form-group col-md-4 input-rounded">
                            @if ($order->order_status==1)
                            <form action="">
                                @csrf
                            <select class="form-control order_details" name="" id="">
                                <option selected id="{{ $order->id }}" value="1">Chưa xử lý</option>
                                <option id="{{ $order->id }}" value="2">Xác nhận</option>
                                <option id="{{ $order->id }}" value="3">Đã thanh toán</option>

                            </select>
                        </form>
                            @elseif ($order->order_status==2)
                            <form action="">
                                @csrf
                            <select class="form-control order_details" name="" id="">
                                <option  id="{{ $order->id }}" value="1">Chưa xử lý</option>
                                <option selected id="{{ $order->id }}" value="2">Xác nhận</option>
                                <option id="{{ $order->id }}" value="3">Đã thanh toán</option>

                            </select>
                        </form>
                            @else
                            <form action="">
                                @csrf
                            <select class="form-control order_details" name="" id="">
                                <option  id="{{ $order->id }}" value="1">Chưa xử lý</option>
                                <option  id="{{ $order->id }}" value="2">Xác nhận</option>
                                <option selected id="{{ $order->id }}" value="3">Đã thanh toán</option>

                            </select>
                        </form>
                            @endif
                       @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-success btn-sm ml-2" target="_blank" href="{{ route('print_order', ['checkout_code' => $orderdetails->order_code]) }}">In đơn
                hàng</a>
            <!-- /# card -->
        </div>
        <!-- /# column -->

        <!-- /# column -->
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $('.order_details').change(function(){
            var order_status=$(this).val();
            var order_id=$(this).children(":selected").attr("id");
            var _token=$('input[name="_token"]').val();
            $.ajax({
                url:'{{ url('/admin/order/update-order') }}',
                method:'POST',
                data:{
                    order_status:order_status,order_id:order_id,_token:_token
                },
                success:function(data){
                    alert('Cập nhập số lượng thành công');
                }
            });

        });
    </script>
@endsection
