@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>Danh sách bài viết</h4>
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
                        <a href="{{ route('add_post') }}" class="btn btn-success">Thêm</a>

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên bài viết</th>
                                <th>Hình ảnh</th>
                                <th>Slug</th>
                                <th>Mô tả bài viết</th>
                                <th>Từ khóa bài viết</th>
                                <th>Danh mục bài viết</th>
                                <th>Hiển thị</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($post)
                                @foreach ($post as $post)
                                <tr>
                                    <td>{{$post->id}}</td>

                                    <td>{{$post->title}}</td>
                                    <td>
                                        <img src="/upload/post/{{ $post->image }}" style="width:150px;height:100px;" alt="">
                                    </td>
                                    <td>{{$post->slug}}</td>

                                   
                                    <td>{!!  $post->description!!}</td>
                                    <td>{{  $post->meta_keywords}}</td>
                                    <td>{{ optional($post->category)->name }}</td>

                                    @if ($post->status==1)
                                        
                                    <td><a href="{{ route('unactive_post',['id'=>$post->id]) }}"><span class="ti-thumb-up"></span></a></td>
                                    @else
                                    <td><a  href="{{ route('active_post',['id'=>$post->id]) }}"><span class="ti-thumb-down"></span></a></td>


                                    @endif
                                    <td>
                                        <form action="#" method="POST">
                                        <a href="{{ route('updatepost',['id'=>$post->id]) }}" class="btn btn-primary">Sửa</a>
                                      
                                        @csrf
                                        @method('DELETE')
                                        <a onclick="return confirm('Bạn có muốn xóa bài viết này không')" href="{{ route('deletePost',['id'=>$post->id]) }}"  class="btn btn-danger">Xóa</a>
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