@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-title">
                <h4>Sửa sân</h4>
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
                    <form method="POST" action="{{  route('update_pitch',['id'=>$pitch->id]) }} " enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên sân</label>
                            <input type="text" name="name" value="{{ $pitch->name }}" class="form-control input-rounded" placeholder="Tên sân">
                        </div>
                        <div class="form-group">
                            <label >Tên loại sân</label>
                           
                                <select name="idCategory" class="form-control input-rounded">
                                    @foreach ($category as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                       
                                    @endforeach
                                    
                                </select>
                          
                        <div>
                            <div class="form-group">
                                <label>Tên sân</label>
                                <input type="file" name="image" class="form-control mb-2 input-rounded">
                                <img class="input-rounded" src="{{ URL::to('/upload/pitch/'.$pitch->image) }}" height="100" width="100" alt="">
                            </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control  input-rounded"  name="description" rows="3" >{{ $pitch->description }}</textarea>
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