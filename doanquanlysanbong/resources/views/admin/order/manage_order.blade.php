@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách đặt sân</h4>
                    @php
                        $message = Session::get('message');
                        
                        if ($message) {
                            echo '<div class="alert alert-danger">
                ' .
                                $message .
                                '
                </div>';
                            Session::put('message', null);
                        }
                    @endphp

                    @php
                        $success = Session::get('success');
                        
                        if ($success) {
                            echo '<div class="alert alert-success">
                                  ' .
                                $success .
                                '
                                </div>';
                            Session::put('success', null);
                        }
                    @endphp
                </div>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table id="row-select" class="display table table-borderd table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày giờ đặt sân</th>
                                    <th>Tình trạng</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @if ($orders)
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $order->order_code }}</td>
                                            <td>{{ $order->created_at }}</td>


                                            <td>
                                                @if ($order->order_status == 1)
                                                    Đơn hàng mới
                                                @elseif ($order->order_status == 2)
                                                    Đã xác nhận
                                                @else
                                                    Đã thanh toán
                                                @endif
                                            </td>



                                            <td>
                                                <form action="#" method="post">
                                                    <a href="{{ route('view_order', ['id' => $order->order_code]) }}"
                                                        class="btn btn-primary "><i class="fa fa-eye"></i> Chi tiết</a>

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="" class="btn btn-danger">Xóa</a>
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
                {{ $orders->links() }}

            </div>
            <!-- /# card -->
        </div>
        <!-- /# column -->

        <!-- /# column -->
    </div>
@endsection
