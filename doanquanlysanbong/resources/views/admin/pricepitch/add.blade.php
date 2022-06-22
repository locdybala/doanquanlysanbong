@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-title">
                <h4>Thêm giá theo khung giờ</h4>
                @php
                $message=Session::get('message');
                if($message){
                    echo '<div class="alert alert-danger">
                              '.$message.'
                            </div>';
                    Session::put('message', null);

                                            }
            @endphp
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form method="POST" action="{{ route('addPricepitch') }}">
                        @csrf
                        
                            <div class="form-group">
                                <label >Tên loại sân</label>
                               
                                    <select name="idCategory" class="form-control input-rounded">
                                        @foreach ($category as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                           
                                        @endforeach
                                        
                                    </select>
                              
                            <div>
                        <div class="form-group">
                            <label>Khung giờ</label>
                            <input data-validation="length" data-validation-length="min3" data-validation-error-msg="Không được để trống" class="form-control  input-rounded" name="timeframe"  >
                        </div>
                        <div class="form-group">
                            <label>Giá tiền</label>
                            <input data-validation="number" data-validation-error-msg="Làm ơn điền kiểu số" class="form-control  input-rounded" name="price"  >
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