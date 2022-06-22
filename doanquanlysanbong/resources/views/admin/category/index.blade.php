@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>Danh sách loại sân</h4>
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
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Hiển Thị</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($category)
                                @foreach ($category as $category)
                                <tr>
                                    <td>{{$category->id}}</td>

                                    <td>{{$category->name}}</td>
                                    @if ($category->status==1)
                                        
                                    <td><a href="{{ route('unactive_category',['id'=>$category->id]) }}"><span class="ti-thumb-up"></span></a></td>
                                    @else
                                    <td><a  href="{{ route('active_category',['id'=>$category->id]) }}"><span class="ti-thumb-down"></span></a></td>


                                    @endif
                                    <td>
                                        <form action="#" method="POST">
                                        <a href="{{ route('updateCategory',['id'=>$category->id]) }}" class="btn btn-primary">Sửa</a>
                                      
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('deleteCategory',['id'=>$category->id]) }}"  class="btn btn-danger">Xóa</a>
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