@extends('admin_layout')
@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection
@section('admin_content')
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Trang chủ</h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Home</li>

                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <section id="main-content">

                <h5 style="text-align: center" class="page-title">Thống kê truy cập</h5>
                <div class="row">

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon  dib">
                                    <i class="ti-world color-primary"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Đang online</div>
                                    <div class="stat-digit">{{ $visitor_count }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib">
                                    <i class="ti-user color-danger border-danger"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Tổng user</div>
                                    <div class="stat-digit">{{ $user_count }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib color-warning">
                                    <i class="ti-bolt-alt"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Tổng truy cập</div>
                                    <div class="stat-digit">{{ $visitor_total }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib">
                                    <i class="ti-money color-success border-success"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Tổng tháng này</div>
                                    <div class="stat-digit">{{ $visitorothismonth_count }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib">
                                    <i class="ti-money color-success border-success"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Tổng tháng trước</div>
                                    <div class="stat-digit">{{ $visitoroflastmonth_count }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="stat-widget-one">
                                <div class="stat-icon dib">
                                    <i class="ti-money color-success border-success"></i>
                                </div>
                                <div class="stat-content dib">
                                    <div class="stat-text">Tổng một năm</div>
                                    <div class="stat-digit">{{ $visitorofyear_count }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="main-content">

                <h5 style="text-align: center" class="page-title">Thống kê doanh thu</h5>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>

                                        </div>
                                        <div class="col-lg-2">
                                            <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>

                                        </div>
                                        <div class="col-lg-2">
                                            <p>
                                                Lọc theo:
                                                <select name="" class="dashboard-filter form-control" id="">
                                                    <option value="">--Chọn--</option>
                                                    <option value="7ngay">7 ngày qua</option>
                                                    <option value="thangtruoc">tháng trước</option>
                                                    <option value="thangnay">tháng này</option>
                                                    <option value="365ngayqua">365 ngày qua</option>

                                                </select>
                                            </p>
                                        </div>
                                    </div>
                                    <input type="button" id="btn-dashboard-filter" class="btn btn--default btn-sm"
                                        value="Lọc kết quả">
                                </form>
                            </div>

                            <div class="card-body">
                                <div id="myfirstchart" style="height: 250px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="main-content">

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Thống kê tổng sản phẩm bài viết đơn hàng</h4>
                                <div id="donut-example" class="morris-donut-inverse"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bài viết xem nhiều</h4><br>
                                <ul class="list-icons">
                                    @foreach ($post_view as $val)
                                        
                                    <li style="margin-bottom: 5px;"><a target="_blank" href="{{ route('baiviet',['slug'=>$val->slug]) }}"><i class="fa fa-check text-info"></i>{{ $val->title }}</a>|<span style="color: red">  Lượt xem:{{ $val->post_view }}</span></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Sẩn phẩm xem nhiều</h4><br>
                                <ul class="list-icons">
                                    @foreach ($pitch_view as $val)
                                        
                                    <li style="margin-bottom: 5px;"><a target="_blank" href="{{ route('viewDetail',['id'=>$val->id]) }}"><i class="fa fa-check text-info"></i>{{ $val->name }}</a>|<span style="color: red">  Lượt xem:{{ $val->pitch_view }}</span></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
        var colorDanger = "#FF1744";
        Morris.Donut({
            element: 'donut-example',
            resize: true,
            colors: [
                '#00AA00',
                '#0033FF',
                '#FF9900',

            ],
            //labelColor:"#cccccc", // text color
            //backgroundColor: '#333333', // border color
            data: [{
                    label: "Sản phẩm",
                    value: {{ $pitch }},
                    color: colorDanger
                },
                {
                    label: "Bài viết",
                    value: {{ $post }},
                },
                {
                    label: "Đơn hàng",
                    value: {{ $order }}
                },
                {
                    label: "Khách hàng",
                    value: {{ $customer }}
                },

            ]
        });

        $(document).ready(function() {
            chart30daysorder();
            var chart = new Morris.Bar({
                element: 'myfirstchart',
                lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                parseTime: false,
                xkey: 'period',
                ykeys: ['order', 'sales', 'profit', 'quantity'],
                behaveLikeLine: true,
                labels: ['đơn hàng', 'doanh số', 'lợi nhuận', 'số lượng']
            });
            $('#btn-dashboard-filter').click(function() {
                var _token = $('input[name="_token"]').val();
                var form_date = $('#datepicker').val();
                var to_date = $('#datepicker2').val();
                $.ajax({
                    url: "{{ url('/admin/filter-by-date') }}",
                    method: "POST",
                    data: {
                        form_date: form_date,
                        to_date: to_date,
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        chart.setData(data)
                    }
                });

            });

            function chart30daysorder() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/admin/days-order') }}",
                    method: "POST",
                    data: {
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        chart.setData(data)
                    }
                });
            }
            $('.dashboard-filter').change(function() {
                var dashboard_value = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/admin/dashboard-filter') }}",
                    method: "POST",
                    data: {
                        dashboard_value: dashboard_value,
                        _token: _token
                    },
                    dataType: "JSON",
                    success: function(data) {
                        chart.setData(data)
                    }
                });
            });
        });
    </script>
@endsection
