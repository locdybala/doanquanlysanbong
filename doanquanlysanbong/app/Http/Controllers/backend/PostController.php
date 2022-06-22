<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index(){
        $post=Post::all();
        return view('admin.post.index',compact('post'));

    }

    public function create(){
        $category=PostCategory::all();
        return view('admin.post.add',compact('category'));
    }
    public function store(Request $request){

        $data=array();
        $data['title']=$request->title;
        $data['cate_post_id']=$request->cate_post_id;
        $data['description']=$request->description;
        $data['content']=$request->content;
        $data['meta_desc']=$request->meta_desc;
        $data['meta_keywords']=$request->meta_keywords;
        $data['slug']=$request->slug;
        $data['status']=$request->status;
        $file=$request->file('image');
        if($file){
            $getnameimage=$file->getClientOriginalName();
            $nameimage=current(explode('.',$getnameimage));
            $new_image=$nameimage.rand(0,99).'.'.$file->getClientOriginalExtension();
            $file->move('/upload/post',$new_image);
            $data['image']=$new_image;
            Post::create($data);
            Session::put('message','Thêm bài viết thành công');
            return redirect()->route('all_post');

        }
        else{
            Session::put('message','Làm ơn thêm hình ảnh');
            return redirect()->route('add_post');
        }
        
        
    }
    public function unactive_post($id){
        Post::find($id)->update([
            'status'=>0
        ]);
        Session::put('success','Không kích hoạt sân thành công');
        return redirect()->route('all_post');
    }
    public function active_post($id){
        Post::find($id)->update([
            'status'=>1
        ]);
        Session::put('success','Kích hoạt sân thành công');
        return redirect()->route('all_post');
        
    }
    public function edit($id){
        $post=Post::find($id);
        $category=PostCategory::all();
        return view('admin.post.update',compact('post','category'));
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
            $file->move('upload/post',$new_image);
            $data['image']=$new_image;
            Post::find($id)->update($data);
            Session::put('success','Cập nhập sân thành công');
            return redirect()->route('all_post');

        }
       
        Post::find($id)->update($data);
        Session::put('success','Cập nhập sân thành công');
        return redirect()->route('all_post');
        
    }
    public function delete($id){
        $post=Post::find($id);
        $postimage=$post->image;
       
        if($postimage){
            $path='public/upload/post'.$postimage;
            unlink($path);

        }
            $post->delete();

        
        Session::put('success','Xóa loại sân thành công');
        return redirect()->route('all_post');

    }
}
