<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    public function index(){
        $category=Category::all();
        return view('admin.category.index',compact('category'));

    }

    public function create(){
        return view('admin.category.add');
    }
    public function store(Request $request){
        Category::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
        ]);
        Session::put('success','Thêm loại sân thành công');
        return redirect()->route('all_category');
    }
    public function unactive_category($id){
        Category::find($id)->update([
            'status'=>0
        ]);
        Session::put('success','Không kích hoạt loại sân thành công');
        return redirect()->route('all_category');
    }
    public function active_category($id){
        Category::find($id)->update([
            'status'=>1
        ]);
        Session::put('success','Kích hoạt loại sân thành công');
        return redirect()->route('all_category');
        
    }
    public function edit($id){
        $category=Category::find($id);
        return view('admin.category.update',compact('category'));
    }
    public function update(Request $request,$id){
        Category::find($id)->update([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        Session::put('success','Sửa loại sân thành công');
        return redirect()->route('all_category');
        
    }
    public function delete($id){
        Category::find($id)->delete();
        Session::put('success','Xóa loại sân thành công');
        return redirect()->route('all_category');

    }
}
