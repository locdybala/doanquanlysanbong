@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-title">
                <h4>Thêm banner</h4>
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
                    <form method="POST" action="{{ route('addSlider') }} " enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên banner</label>
                            <input type="text" name="slider_name" class="form-control input-rounded" placeholder="Tên sân">
                        </div>
                     
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="file" data-validation="mime size required" 
                                data-validation-allowing="jpg, png" 
                                data-validation-max-size="300kb" 
                                data-validation-error-msg-required="Không có tệp nào được chọn" name="slider_image" class="form-control input-rounded">
                            </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control  input-rounded" name="slider_description" id="ckeditor1" rows="3" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Hiển thị</label>
                            <select name="slider_status" class="form-control input-rounded">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện thị</option>
                                
                            </select>
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