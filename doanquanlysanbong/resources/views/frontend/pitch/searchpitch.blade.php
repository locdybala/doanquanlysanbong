@extends('frontend_layout')
@section('title')
    <title>Tìm kiếm</title>
@endsection
@section('style')
@endsection
@section('content')
    <div style="padding: 50px 0"  class="grid wide">
        <h3  class=" category__heading">KẾT QUẢ</h3>
        <p style="margin-bottom:10px" class="product__name">Từ khóa tìm kiếm : {{ $keyword }}</p>   
        <div class="row">
            @foreach ($search as $pitch)
                <div style="padding:0 10px" class="col l-3 m-4 s-6">
                    <div class="product">
                        <div class="product__avt" style="background-image: url(upload/pitch/{{ $pitch->image }});">
                        </div>
                        <div class="product__info">
                            <h3 class="product__name">{{ $pitch->name }}</h3>


                        </div>
                        <a href="{{ route('viewDetail', ['id' => $pitch->id]) }}" class="viewDetail">Xem chi tiết</a>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
@endsection
