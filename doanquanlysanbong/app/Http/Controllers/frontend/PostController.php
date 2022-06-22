<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function danhmucbaiviet($slug){

        $postcategory=PostCategory::all();
        $category=PostCategory::where('slug',$slug)->take(1)->get();
    
        foreach($category as $cate){
            $cate_id=$cate->id;
            $catename=$cate->name;
        }
        $post=Post::with('category')->where('status',0)->where('cate_post_id',$cate_id)->paginate(10);
        return view('frontend.post.categorypost',compact('postcategory','post','category','catename'));
    }

    public function baiviet($slug){
        $postcategory=PostCategory::all();

        $post=Post::where('slug',$slug)->first();
        return view('frontend.post.baiviet',compact('postcategory','post'));
    }
}
