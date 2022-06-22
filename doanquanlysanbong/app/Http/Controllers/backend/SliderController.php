<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class SliderController extends Controller
{
    public function index(){
        $slider=Slider::all();
        return view('admin.slider.index',compact('slider'));
    }
    public function create(){
        return view('admin.slider.add');
    }

    public function store(Request $request){

        $data=array();
        $data['slider_name']=$request->slider_name;
        
        $data['slider_description']=$request->slider_description;
        $data['slider_status']=$request->slider_status;
        $file=$request->file('slider_image');
        if($file){
            $getnameimage=$file->getClientOriginalName();
            $nameimage=current(explode('.',$getnameimage));
            $new_image=$nameimage.rand(0,99).'.'.$file->getClientOriginalExtension();
            $file->move('upload/slider',$new_image);
            $data['slider_image']=$new_image;
            Slider::create($data);
            Session::put('success','Thêm banner thành công');
            return redirect()->route('all_banner');

        }
        $data['slider_image']='';
        Slider::create($data);
        Session::put('success','Thêm sân thành công');
        return redirect()->route('all_banner');
    }


    public function unactive_slider($id){
        Slider::find($id)->update([
            'slider_status'=>0
        ]);
        Session::put('message','Không kích hoạt sân thành công');
        return redirect()->route('all_banner');
    }
    public function active_slider($id){
        Slider::find($id)->update([
            'slider_status'=>1
        ]);
        Session::put('success','Kích hoạt sân thành công');
        return redirect()->route('all_banner');
        
    }
}
