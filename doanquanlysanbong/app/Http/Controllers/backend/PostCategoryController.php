<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class PostCategoryController extends Controller
{
    public function index(){
        $category=PostCategory::all();
        return view('admin.postcategory.index',compact('category'));
    }
    public function create(){
        return view('admin.postcategory.add');
    }
    public function store(Request $request){
        PostCategory::create([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'description'=>$request->description,
            'status'=>$request->status,
        ]);
        Session::put('success','Thêm danh mục bài viết thành công');
        return redirect()->route('all_category_post');
    }
    public function edit($id){
        $category=PostCategory::find($id);
        return view('admin.postcategory.update',compact('category'));
    }
    public function update(Request $request,$id){
        PostCategory::find($id)->update([
            'name'=>$request->name,
            'slug'=>$request->slug,

            'description'=>$request->description,
            'status'=>$request->status,

        ]);
        Session::put('success','Sửa danh mục bài viết thành công');
        return redirect()->route('all_category_post');
    }
    public function delete($id){
        PostCategory::find($id)->delete();
        Session::put('success','Xóa danh mục bài viết thành công');
        return redirect()->route('all_category_post');

    }
}
