<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    @yield('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <link href="{{ asset('backend/css/lib/calendar2/pignose.calendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/lib/chartist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/lib/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/lib/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/lib/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/lib/weather-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/lib/menubar/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/lib/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="{{ route('dashboard') }}">
                            <img src="{{ asset('backend/images/logo.png') }}" alt="" /> <span>Admin</span></a></div>
                    <li class="label">Main</li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-home"></i> Dashboard <span
                                class="badge badge-primary">2</span> <span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            <li><a href="index.html">Dashboard 1</a></li>
                            <li><a href="index1.html">Dashboard 2</a></li>
                        </ul>
                    </li>

                    <li class="label">Apps</li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Quản lý loại sân<span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @hasrole('admin')
                                <li><a href="{{ route('add_category') }}">Thêm loại sân</a></li>
                            @endhasrole
                            <li><a href="{{ route('all_category') }}">Xem danh sách loại sân</a></li>

                        </ul>
                    </li>
                    @hasrole('admin')
                        <li><a href="{{ route('all_banner') }}"><i class="ti-calendar"></i> Banner</a></li>
                    @endhasrole

                    <li><a href="{{ route('all_pricepitch') }}"><i class="ti-calendar"></i> Quản lý giá theo khung
                            giờ</a></li>

                    <li><a href="{{ route('all_pitch') }}"><i class="ti-calendar"></i> Quản lý sân bóng</a></li>
                    <li><a href="{{ route('manageorder') }}"><i class="ti-calendar"></i> Quản lý đặt sân</a></li>
                    <li><a href="{{ route('managecoupon') }}"><i class="ti-calendar"></i> Quản lý mã giảm giá</a>
                    </li>
                    @impersonate
                        <li><a href="{{ route('impersonate_destroy') }}"><i class="ti-calendar"></i> Stop chuyển
                                quyền</a></li>
                    @endimpersonate
                    @hasrole('admin')
                        <li><a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Quản lý user<span
                                    class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                <li><a href="{{ route('add_user') }}">Thêm user</a></li>
                                <li><a href="{{ route('all_users') }}">Xem danh sách user</a></li>

                            </ul>
                        </li>
                    @endhasrole
                    <li><a href="{{ route('all_category_post') }}"><i class="ti-calendar"></i> Quản lý danh mục
                            bài viết</a></li>
                    <li><a href="{{ route('all_post') }}"><i class="ti-calendar"></i> Quản lý bài viết</a></li>

                    <li><a href="{{ route('logout_auth') }}"><i class="ti-close"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="float-right">


                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar">
                                    @php
                                        // $name = Auth::user('name');
                                        $name = Auth::user()->name;
                                        if ($name) {
                                            echo $name;
                                        }
                                    @endphp
                                    <i class="ti-angle-down f-s-10"></i>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">

                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="ti-user"></i>
                                                    <span>Profile</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <i class="ti-email"></i>
                                                    <span>Inbox</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="ti-settings"></i>
                                                    <span>Setting</span>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    <i class="ti-lock"></i>
                                                    <span>Lock Screen</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('logout_auth') }}">
                                                    <i class="ti-power-off"></i>
                                                    <span>Đăng xuất</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="content-wrap">
        @yield('admin_content')
    </div>



    <!-- jquery vendor -->
    <script src="{{ asset('backend/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/js/lib/jquery.nanoscroller.min.js') }}"></script>
    <script type="text/javascript" src="/test/wp-content/themes/child/script/jquery.jcarousel.min.js"></script>
    <!-- nano scroller -->
    <script src="{{ asset('backend/js/lib/menubar/sidebar.js') }}"></script>
    <script src="{{ asset('backend/js/lib/preloader/pace.min.js') }}"></script>
    <!-- sidebar -->

    <script src="{{ asset('backend/js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/scripts.js') }}"></script>
    <!-- bootstrap -->

    <script src="{{ asset('backend/js/lib/calendar-2/moment.latest.min.js') }}"></script>
    <script src="{{ asset('backend/js/lib/calendar-2/pignose.calendar.min.js') }}"></script>
    <script src="{{ asset('backend/js/lib/calendar-2/pignose.init.js') }}"></script>
    <script src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>


    <script src="{{ asset('backend/js/lib/weather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('backend/js/lib/weather/weather-init.js') }}"></script>
    <script src="{{ asset('backend/js/lib/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('backend/js/lib/circle-progress/circle-progress-init.js') }}"></script>
    <script src="{{ asset('backend/js/lib/chartist/chartist.min.js') }}"></script>
    <script src="{{ asset('backend/js/lib/sparklinechart/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('backend/js/lib/sparklinechart/sparkline.init.js') }}"></script>
    <script src="{{ asset('backend/js/lib/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('backend/js/lib/owl-carousel/owl.carousel-init.js') }}"></script>
    
    <!-- scripit init-->
    <script src="//cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <script src="{{ asset('backend/js/dashboard2.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script src="{{ asset('backend/js/jquery.form-validator.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    
    <script>
        $(function() {
            $("#datepicker").datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-mm-dd",
                dayNamesMin:['Thứ 2','Thứ 3','Thứ 4','Thứ 5', 'Thứ 6', 'Thứ 7','Chủ nhật'],
                duration:"slow"
            });
            $("#datepicker2").datepicker({
                prevText:"Tháng trước",
                nextText:"Tháng sau",
                dateFormat:"yy-mm-dd",
                dayNamesMin:['Thứ 2','Thứ 3','Thứ 4','Thứ 5', 'Thứ 6', 'Thứ 7','Chủ nhật'],
                duration:"slow"
            });

        });
    </script>
    <script type="text/javascript">
        $.validate({

        });
    </script>
    <script>
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
        CKEDITOR.replace('ckeditor2');
        CKEDITOR.replace('ckeditor3');

        CKEDITOR.replace('ckeditor4');
    </script>
    @yield('javascript')
</body>

</html>s
