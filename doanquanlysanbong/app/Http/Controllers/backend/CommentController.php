<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function sendcomment(Request $request){
        $pitch_id=$request->pitchid_hidden;
        $commemt_content=$request->commemt_content;
        $comment_name=$request->comment_name;
        $comment=new Comment();
        $comment->comment=$commemt_content;
        $comment->comment_name=$comment_name;
        $now=Carbon::now('Asia/Ho_Chi_Minh');
        $comment->comment_date=$now;
        $comment->product_id=$pitch_id;
        $comment->save();

    }
}
