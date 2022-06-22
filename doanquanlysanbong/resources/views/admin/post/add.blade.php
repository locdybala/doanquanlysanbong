@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>Thêm bài viết</h4>
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
                    <form method="POST" action="{{ route('addPost') }} " enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input data-validation="length" value="" data-validation-length="min3" onkeyup="ChangeToSlug()" id="name_categorypost" data-validation-error-msg="Không được để trống" type="text" name="title" class="form-control input-rounded" placeholder="Tên loại sân">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input data-validation="length" data-validation-length="min3" id="slug" data-validation-error-msg="Không được để trống" type="text" name="slug" class="form-control input-rounded" placeholder="Tên loại sân">
                        </div>
                        <div class="form-group">
                            <label >Danh mục bài viết</label>
                           
                                <select name="cate_post_id" class="form-control input-rounded">
                                    @foreach ($category as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                       
                                    @endforeach
                                    
                                </select>
                          
                        <div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="file" data-validation="mime size required" 
                                data-validation-allowing="jpg, png" 
                                data-validation-max-size="300kb" 
                                data-validation-error-msg-required="Không có tệp nào được chọn" name="image" class="form-control input-rounded">
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea class="form-control  input-rounded" name="description" id="ckeditor1" rows="5" ></textarea>
                            </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea class="form-control  input-rounded" name="content" id="ckeditor2" rows="5" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta từ khóa</label>
                            <textarea class="form-control  input-rounded" name="meta_keywords" id="ckeditor2" rows="5" ></textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta nội dung</label>
                            <textarea class="form-control  input-rounded" name="meta_desc" id="ckeditor2" rows="5" ></textarea>
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

@section('script')
<script>
      function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("name_categorypost").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        }
         
    </script>
@endsection