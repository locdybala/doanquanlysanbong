<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PitchPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PricePitchController extends Controller
{
    public function index(){
        $pricepitch=PitchPrice::all();
        return view('admin.pricepitch.index',compact('pricepitch'));
        

    }
    public function create(){
        $category=Category::all();
        return view('admin.pricepitch.add',compact('category'));
    }
    public function store(Request $request){
        PitchPrice::create([
            'idCategory'=>$request->idCategory,
            'timeframe'=>$request->timeframe,
            'price'=>$request->price,
        ]);
        Session::put('message','Thêm giá tiền theo khung giờ thành công');
        return redirect()->route('all_pricepitch');
    }
    public function edit($id){
        $pitchprice=PitchPrice::find($id);
        $category=Category::all();
        return view('admin.pricepitch.update',compact('pitchprice','category'));
    }

    public function update(Request $request,$id){
        PitchPrice::find($id)->update([
            'idCategory'=>$request->idCategory,
            'timeframe'=>$request->timeframe,
            'price'=>$request->price,
        ]);
        Session::put('success','Sửa loại sân thành công');
        return redirect()->route('all_pricepitch');
        
    }
    public function delete($id){
        PitchPrice::find($id)->delete();
        Session::put('success','Xóa giá theo khung giờ thành công');
        return redirect()->route('all_pricepitch');

    }
}
