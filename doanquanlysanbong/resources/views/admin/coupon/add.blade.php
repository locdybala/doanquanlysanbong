@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-title">
                <h4>Thêm mã giảm giá</h4>
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
                    <form method="POST" action="{{ route('addCoupon') }} ">
                        @csrf
                        <div class="form-group">
                            <label>Tên mã giảm giá</label>
                            <input type="text" name="coupon_name" class="form-control input-rounded" placeholder="Tên mã giảm giá">
                        </div>
                        <div class="form-group">
                            <label>Ngày bắt đầu</label>
                            <input type="text" name="coupondate_start" id="start_coupon" class="form-control input-rounded" placeholder="Ngày bắt đầu">
                        </div><div class="form-group">
                            <label>Ngày kết thúc</label>
                            <input type="text" name="coupondate_end" id="end_coupon" class="form-control input-rounded" placeholder="Ngày kết thúc">
                        </div>
                        <div class="form-group">
                            <label>Mã giảm giá</label>
                            <input type="text" name="coupon_code" class="form-control input-rounded" placeholder="Mã giảm giá">
                        </div>
                        <div class="form-group">
                            <label>Số lượng mã</label>
                            <input type="text" name="coupon_times" class="form-control input-rounded" placeholder="Số lượng mã">
                        </div>
                        <div class="form-group">
                            <label >Tính năng mã</label>
                           
                                <select name="coupon_condition" class="form-control input-rounded">
                                    <option value="0">----Chọn-------</option>
                                    <option value="1">Giảm theo phần trăm</option>
                                    <option value="2">Giảm theo tiền</option>
                                </select>
                          
                        <div>
                            <div class="form-group">
                                <label>Nhập số phần trăm hoặc tiền</label>
                                <input type="text" name="coupon_number" class="form-control input-rounded" placeholder="Nhập số giảm">
                            </div> 
                        
                       
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /# column -->
   
    <!-- /# column -->
</div>
@endsection
@section('javascript')
<script>
    $(function() {
        $("#start_coupon").datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:"yy/mm/dd",
            dayNamesMin:['Thứ 2','Thứ 3','Thứ 4','Thứ 5', 'Thứ 6', 'Thứ 7','Chủ nhật'],
            duration:"slow"
        });
        $("#end_coupon").datepicker({
            prevText:"Tháng trước",
            nextText:"Tháng sau",
            dateFormat:"yy/mm/dd",
            dayNamesMin:['Thứ 2','Thứ 3','Thứ 4','Thứ 5', 'Thứ 6', 'Thứ 7','Chủ nhật'],
            duration:"slow"
        });

    });
</script>
@endsection