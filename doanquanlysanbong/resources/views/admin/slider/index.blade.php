@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>Danh sách banner</h4>
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
                        <a href="{{ route('add_slider') }}" class="btn btn-success">Thêm</a>

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên banner</th>
                                <th>Ảnh</th>
                                <th>Mô tả</th>
                                <th>Hiển thị</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($slider)
                                @foreach ($slider as $slider)
                                <tr>
                                    <td>{{$slider->id}}</td>

                                    <td>{{$slider->slider_name}}</td>
                                    
                                    <td>
                                        <img src="/upload/slider/{{ $slider->slider_image }}" style="width:150px;height:100px;" alt="">
                                    </td>
                                    <td>{{  $slider->slider_description}}</td>
                                    @if ($slider->slider_status==1)
                                        
                                    <td><a href="{{ route('unactive_slider',['id'=>$slider->id]) }}"><span class="ti-thumb-up"></span></a></td>
                                    @else
                                    <td><a  href="{{ route('active_slider',['id'=>$slider->id]) }}"><span class="ti-thumb-down"></span></a></td>


                                    @endif
                                    <td>
                                        <form action="#" method="POST">
                                        <a href="{{ route('updateSlider',['id'=>$slider->id]) }}" class="btn btn-primary">Sửa</a>
                                      
                                        @csrf
                                        @method('DELETE')
                                        <a onclick="return confirm('Bạn ccos muốn xóa sân này không')" href="{{ route('deleteSlider',['id'=>$slider->id]) }}"  class="btn btn-danger">Xóa</a>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <td>Không có dữ liệu</td>
                                
                            @endif
                            
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
@endsection