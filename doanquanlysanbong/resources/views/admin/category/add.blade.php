@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-title">
                <h4>Thêm loại sân</h4>
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
                    <form method="POST" action="{{ route('addCategory') }}">
                        @csrf
                        <div class="form-group">
                            <label>Tên loại sân</label>
                            <input data-validation="length" data-validation-length="min3" data-validation-error-msg="Không được để trống" type="text" name="name" class="form-control input-rounded" placeholder="Tên loại sân">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea data-validation="length" data-validation-length="min3" data-validation-error-msg="Không được để trống" id="ckeditor" class="form-control  input-rounded" name="description" rows="3" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Hiển thị</label>
                            <select name="status" class="form-control input-rounded">
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