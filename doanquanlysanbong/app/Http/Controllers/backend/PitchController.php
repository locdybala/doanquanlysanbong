<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Pitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;

class PitchController extends Controller
{
    public function index(){
        $pitch=Pitch::all();
        return view('admin.pitch.index',compact('pitch'));

    }

    public function create(){
        $category=Category::all();
        return view('admin.pitch.add',compact('category'));
    }
    public function store(Request $request){

        $data=array();
        $data['name']=$request->name;
        $data['idCategory']=$request->idCategory;
        $data['description']=$request->description;
        $data['status']=$request->status;
        $file=$request->file('image');
        if($file){
            $getnameimage=$file->getClientOriginalName();
            $nameimage=current(explode('.',$getnameimage));
            $new_image=$nameimage.rand(0,99).'.'.$file->getClientOriginalExtension();
            $file->move('/upload/pitch',$new_image);
            $data['image']=$new_image;
            Pitch::create($data);
            Session::put('message','Thêm sân thành công');
            return redirect()->route('add_Pitch');

        }
        $data['image']='';
        Pitch::create($data);
        Session::put('message','Thêm sân thành công');
        return redirect()->route('add_Pitch');
    }
    public function unactive_Pitch($id){
        Pitch::find($id)->update([
            'status'=>0
        ]);
        Session::put('success','Không kích hoạt sân thành công');
        return redirect()->route('all_pitch');
    }
    public function active_Pitch($id){
        Pitch::find($id)->update([
            'status'=>1
        ]);
        Session::put('success','Kích hoạt sân thành công');
        return redirect()->route('all_pitch');
        
    }
    public function edit($id){
        $pitch=Pitch::find($id);
        $category=Category::all();
        return view('admin.pitch.update',compact('pitch','category'));
    }
    public function update(Request $request,$id){
        $data=array();
        $data['name']=$request->name;
        $data['idCategory']=$request->idCategory;
        $data['description']=$request->description;
        $file=$request->file('image');
        if($file){
            $getnameimage=$file->getClientOriginalName();
            $nameimage=current(explode('.',$getnameimage));
            $new_image=$nameimage.rand(0,99).'.'.$file->getClientOriginalExtension();
            $file->move('upload/pitch',$new_image);
            $data['image']=$new_image;
            Pitch::find($id)->update($data);
            Session::put('success','Cập nhập sân thành công');
            return redirect()->route('all_pitch');

        }
       
        Pitch::find($id)->update($data);
        Session::put('success','Cập nhập sân thành công');
        return redirect()->route('all_pitch');
        
    }
    public function delete($id){
        Pitch::find($id)->delete();
        Session::put('success','Xóa loại sân thành công');
        return redirect()->route('all_pitch');

    }
}
