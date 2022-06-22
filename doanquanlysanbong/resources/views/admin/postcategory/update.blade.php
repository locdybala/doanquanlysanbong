@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-title">
                <h4>Sửa danh mục bài viết</h4>
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
                    <form method="POST" action="{{ route('editCategoryPost',['id'=>$category->id]) }}">
                        @csrf
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input data-validation="length" value="{{ $category->name }}" data-validation-length="min3" onkeyup="ChangeToSlug()" id="name_categorypost" data-validation-error-msg="Không được để trống" type="text" name="name" class="form-control input-rounded" placeholder="Tên loại sân">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input data-validation="length" value="{{ $category->slug }}" data-validation-length="min3" id="slug" data-validation-error-msg="Không được để trống" type="text" name="slug" class="form-control input-rounded" placeholder="Tên loại sân">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea data-validation="length"  data-validation-length="min3" data-validation-error-msg="Không được để trống" id="ckeditor" class="form-control  input-rounded" name="description" rows="3" >{{ $category->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hiển thị</label>
                            <select name="status" class="form-control input-rounded">
                                @if($category->status==0)
                                <option selected value="0">Ẩn</option>
                                <option value="1">Hiện thị</option>
                                @else
                                <option  value="0">Ẩn</option>
                                <option selected value="1">Hiện thị</option>
                                @endif
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