@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-title">
                <h4>Sửa giá theo khung giờ</h4>
                @php
                $message=Session::get('message');
                if($message){
                    echo '<div class="alert alert-danger">
                              '.$message.'
                            </div>';
                    Session::put('message', null);

                                            }
            @endphp
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form method="POST" action="{{ route('update_pricepitch',['id'=>$pitchprice->id]) }}">
                        @csrf
                        
                            <div class="form-group">
                                <label >Tên loại sân</label>
                               
                                    <select name="idCategory" class="form-control input-rounded">
                                        @foreach ($category as $category)
                                        @if ($category->id==$pitchprice->idCategory)
                                        <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                        @else
                                        <option  value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                           
                                        @endforeach
                                        
                                    </select>
                              
                            
                        <div class="form-group">
                            <label>Khung giờ</label>
                            <input class="form-control  input-rounded" value="{{ $pitchprice->timeframe }}" name="timeframe"  >
                        </div>
                        <div class="form-group">
                            <label>Giá tiền</label>
                            <input class="form-control  input-rounded" value="{{ $pitchprice->price }}" name="price"  >
                        </div>
                        
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /# column -->
   
    <!-- /# column -->
</div>
@endsection