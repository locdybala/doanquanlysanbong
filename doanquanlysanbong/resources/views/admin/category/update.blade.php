@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-title">
                <h4>Sửa loại sân</h4>
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
                    <form method="POST" action="{{ route('update_category',['id'=>$category->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="id" value="{{ $category->id }}" readonly class="form-control input-rounded"  placeholder="Tên loại sân">
                        </div>
                        <div class="form-group">
                            <label>Tên loại sân</label>
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control input-rounded"  placeholder="Tên loại sân">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control  input-rounded" name="description" rows="3" >{{ $category->description }}</textarea>
                        </div>
                       
                        <button type="submit" class="btn btn-success">Cập nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /# column -->
   
    <!-- /# column -->
</div>
@endsection