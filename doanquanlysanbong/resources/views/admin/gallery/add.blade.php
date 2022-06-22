@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Thêm thư viện hình ảnh</h4>
                    @php
                        $message = Session::get('message');
                        if ($message) {
                            echo '<div class="alert alert-success">
                                      ' .
                                $message .
                                '
                                    </div>';
                            Session::put('message', null);
                        }
                    @endphp
                </div>
                <form method="post" enctype="multipart/form-data"
                    action="{{ url('/admin/gallery/insert_gallery/' . $pitch_id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="file[]" accept="image/*" multiple>
                            <span id="error_gallery"></span>
                        </div>
                        <div class="col-md-3">
                            <button type="sumbit" name="upload" class="btn btn-success"> Tải ảnh</button>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                    <div class="basic-form">
                        <input type="hidden" value="{{ $pitch_id }}" class="pitch_id">
                        <form action="">
                            @csrf
                            <div id="gallery_load">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên hình ảnh</th>
                                            <th>Hình ảnh</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>



                                    </tbody>
                                </table>
                            </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            load_gallery();

            function load_gallery() {
                var pitch_id = $('.pitch_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/admin/gallery/select_gallery') }}",
                    method: "POST",
                    data: {
                        pitch_id: pitch_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#gallery_load').html(data);
                    }
                });
            }
            $('#file').change(function() {
                var error = '';
                var files = $('#file')[0].files;
                if (files.length > 5) {
                    error += '<p>Bạn chỉ được phép chọn tối đa 5 ảnh</p>';
                } else if (files.length == '') {
                    error += '<p>Bạn không được bỏ trống ảnh</p>';
                } else if (files.size > 2000000) {
                    error += '<p>File ảnh không được lớn hơn 2MB</p>';
                }
                if (error == '') {

                } else {
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">' + error + '</span>')
                    return false;
                }

            });
            $(document).on('blur', '.edit_gal_name', function() {
                var gal_id = $(this).data('gal_id');
                var gal_text = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/admin/gallery/update_galleryname') }}",
                    method: "POST",
                    data: {
                        gal_id: gal_id,
                        gal_text: gal_text,
                        _token: _token
                    },
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-success">Cập nhập tên hình ảnh thành công</span>'
                            );
                    }
                });
            });
            $(document).on('click', '.delete-gallery', function() {
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if (confirm('Bạn muốn xóa hình ảnh này không?')) {

                    $.ajax({
                        url: "{{ url('/admin/gallery/delete_gallery') }}",
                        method: "POST",
                        data: {
                            gal_id: gal_id,
                            _token: _token
                        },
                        success: function(data) {
                            load_gallery();
                            $('#error_gallery').html(
                                '<span class="text-success">Xóa ảnh thành công</span>');
                        }
                    });
                }

            });
            $(document).on('change', '.file_image', function() {
                var gal_id = $(this).data('gal_id');
                var image = document.getElementById('file-' + gal_id).files[0];
                var form_data = new FormData();
                form_data.append("file", document.getElementById('file-' + gal_id).files[0]);
                form_data.append("gal_id", gal_id);

                $.ajax({
                    url: "{{ url('/admin/gallery/update_gallery') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 
                        form_data
                    ,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-success">Cập nhập ảnh thành công</span>');
                    }
                });


            });
        });
    </script>
@endsection
