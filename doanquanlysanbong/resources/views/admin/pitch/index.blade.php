@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>Danh sách sân</h4>
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
                        <a href="{{ route('add_Pitch') }}" class="btn btn-success">Thêm</a>

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sân</th>
                                <th>Thư viện ảnh</th>
                                <th>Loại sân</th>
                                <th>Ảnh</th>
                                <th>Mô tả</th>
                                <th>Hiển thị</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($pitch)
                                @foreach ($pitch as $pitch)
                                <tr>
                                    <td>{{$pitch->id}}</td>

                                    <td>{{$pitch->name}}</td>
                                    <td><a href="{{ route('add_gallery',['id'=>$pitch->id]) }}">Thêm thư viện ảnh</a></td>
                                    <td>{{ optional($pitch->category)->name }}</td>
                                    <td>
                                        <img src="/upload/pitch/{{ $pitch->image }}" style="width:150px;height:100px;" alt="">
                                    </td>
                                    <td>{!!  $pitch->description!!}</td>
                                    @if ($pitch->status==1)
                                        
                                    <td><a href="{{ route('unactive_pitch',['id'=>$pitch->id]) }}"><span class="ti-thumb-up"></span></a></td>
                                    @else
                                    <td><a  href="{{ route('active_pitch',['id'=>$pitch->id]) }}"><span class="ti-thumb-down"></span></a></td>


                                    @endif
                                    <td>
                                        <form action="#" method="POST">
                                        <a href="{{ route('updatepitch',['id'=>$pitch->id]) }}" class="btn btn-primary">Sửa</a>
                                      
                                        @csrf
                                        @method('DELETE')
                                        <a onclick="return confirm('Bạn ccos muốn xóa sân này không')" href="{{ route('deletepitch',['id'=>$pitch->id]) }}"  class="btn btn-danger">Xóa</a>
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