@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>Danh sách comment</h4>
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
                                <th>Duyệt</th>
                                <th>Tên người gửi</th>
                                <th>Bình luận</th>
                                <th>Ngày gửi</th>
                                <th>Sản phẩm</th>
                                <th>Quản lý</th>

                            </tr>
                        </thead>

                        <tbody>
                            @if ($comments)
                                @foreach ($comments as $comment)
                                <tr>
                                    <td>
                                    @if($comment->comment_status==1)
                                    <input type="button" data-comment_status="0" data-comment_id="{{ $comment->id }}" id="{{ $comment->product_id }}" class="btn btn-duyet btn-sm btn-primary" value="Duyệt">
                                    @else
                                    <input type="button" data-comment_status="1" data-comment_id="{{ $comment->id }}" id="{{ $comment->product_id }}" class="btn  btn-danger btn-boduyet btn-sm" value="Bỏ duyệt">

                                    @endif
                                </td>
                                    <td>{{$comment->comment_name}}</td>
                                    <td>{{$comment->comment}}
                                        @if($comment->comment_status==0)
                                    <div class="form-group">
                                        <textarea  class="form-control reply-comment" name="" id="" rows="1"></textarea>
                                        
                                    </div>
                                    <button class="btn btn-sm btn-success btn-reply-comment">Trả lời bình luận</button>
                                    </td>
                                    @endif
                                    <td>{{$comment->comment_date}}</td>
                                    <td><a target="_blank" href="{{('/chitietsan/'.$comment->product_id) }}">{{$comment->pitch->name}}</a>
                                        </td>

                                
                                    <td>
                                        <form action="#" method="POST">
                                        <a href="" class="btn btn-primary">Sửa</a>
                                      
                                        @csrf
                                        @method('DELETE')
                                        <a href=""  class="btn btn-danger">Xóa</a>
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

@section('javascript')
    <script type="text/javascript">
        $('.btn-duyet').click(function(){
            var comment_status=$(this).data('comment_status');
            var comment_id=$(this).data('comment_id');
            var product_id=$(this).attr('id');
            $.ajax({
                method: "POST",
                url: "{{ url('/admin/comment/allow_comment') }}",
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    
                }
            });


        });
    </script>
@endsection