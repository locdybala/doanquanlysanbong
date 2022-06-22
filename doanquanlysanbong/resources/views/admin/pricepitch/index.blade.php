@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-title">
                    <h4>Danh sách giá sân theo giờ</h4>
                    
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
                            <a href="{{ route('add_pricepitch') }}" class="btn btn-success">Thêm</a>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Loại sân</th>
                                    <th>Khung giờ</th>
                                    <th>Gía tiền</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                
                                    @foreach ($pricepitch as $pricepitch)
                                        <tr>
                                            <td>{{ $pricepitch->id }}</td>

                                            <td>{{ optional($pricepitch->category)->name }}</td>
                                            <td>{{ $pricepitch->timeframe }}</td>
                                            <td>{{ number_format($pricepitch->price) }}</td>
                                            <td>
                                                <form action="#" method="POST">
                                                <a href="{{ route('updatePricepitch',['id'=>$pricepitch->id]) }}" class="btn btn-primary">Sửa</a>
                                              
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('deletePricepitch',['id'=>$pricepitch->id]) }}"  class="btn btn-danger">Xóa</a>
                                            </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                

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
