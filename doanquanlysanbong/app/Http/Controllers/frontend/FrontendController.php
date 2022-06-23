<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use App\Models\Pitch;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index(Request $request){
        $post=Post::all()->take(4);
        $postcategory=PostCategory::all();
       $slider=Slider::orderBy('id','DESC')->where('slider_status','1')->take(3)->get();
        $category=Category::all();

        $pitchs=Pitch::all();
        return view('frontend.home',compact('category','pitchs','slider','postcategory','post'));
    }
    public function contact(){
        $postcategory=PostCategory::all();
        return view('frontend.contact',compact('postcategory'));
    }
    public function viewDetail($id){
        $postcategory=PostCategory::all();

        $pitchdetail=Pitch::find($id);
        $pitchprice=DB::table('pitches')
        ->join('categories','pitches.idCategory','=','categories.id')
        ->join('pitch_prices','pitch_prices.idCategory','=','categories.id')
        ->where('pitches.id',$id)->get();

        foreach($pitchprice as $key =>$value){
            foreach($pitchdetail->orderDetails as $order_detail) {
                if ($order_detail->pitch_date == date('Y-m-d') && $value->timeframe == $order_detail->pitch_timeframe) {
                    $pitchprice[$key]->status = 'Hết sân';
                    break;
                }
                else {
                    $pitchprice[$key]->status = 'Còn trống';
                }
            }
            $category_id=$value->idCategory;
        }
        $related_pitch=DB::table('pitches')
        ->where('pitches.idCategory',$category_id)->whereNotIn('pitches.id',[$id])->get();
        $gallery=Gallery::where('pitch_id',$id)->get();
        return view('frontend.pitchdetail',compact('pitchdetail','gallery','pitchprice','related_pitch','postcategory'));
    }
    public function search(Request $request){
        $postcategory=PostCategory::all();

        $keyword=$request->keyword_submit;
        $search=Pitch::where('name','like','%'.$keyword.'%')->get();
        return view('frontend.pitch.searchpitch',compact('search','postcategory','keyword'));
    }
    public function sendmail(){
        $toname="Loc Dybala";
        $toemail="1811060337@hunre.edu.vn";
        $data=array("name"=>"Mail từ tk khách hàng","body"=>"gửi về vấn đề hàng hóa");
        Mail::send('test', $data, function ($message) use ($toname,$toemail){
            
            $message->to($toemail)->subject('Test thử gửi mail');
            $message->from($toemail,$toname);

        });
    }
    public function login_customer_google(){
      
    }
    public function checktinhtrang(Request $request){
        $data=$request->all();
        $ngaysudung=$data['ngaysudung'];
        $pitchid_hidden=$data['pitchid_hidden'];
        $timeframe=$data['timeframe'];
        $order=Order_detail::where('pitch_timeframe',$timeframe)->where('pitch_id',$pitchid_hidden)->where('pitch_date',$ngaysudung)->get();
        $count=count($order);
        if($count==0){
            return $data=0;
        }else{
            return $data=1;
        }
    }
    public function loadcomment(Request $request){
        $pitchid=$request->pitchid_hidden;
        $comment=Comment::where('product_id',$pitchid)->where('comment_status',0)->get();
        $output='';
        foreach($comment as $key => $comment){
            $output.='  <li class="rate__item">
            <div class="rate__info">
                <img src="https://lh3.googleusercontent.com/ogw/ADGmqu9PFgn_rHIm9i3eIlVr5RwzwY2w8EystHF213wj=s32-c-mo"
                    alt="">
                <h3 class="rate__user">'.$comment->comment_name.'</h3>
               
                <div class="rate__star">
                    <div class="group-star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <p style="margin-bottom:10px;" class="rate__comment">'.$comment->comment_date.'</p>
            <div class="rate__comment">'.$comment->comment.'</div>
        </li>';
        }
        echo $output;
    }

    public function getOrderDetails(Request $request){
        $data = $request->all();
        $ngaysudung = $data['ngaysudung'];
        $pitchid_hidden = $data['pitchid_hidden'];
        $pitchdetail=Pitch::find($pitchid_hidden);
        $pitchprice=DB::table('pitches')
        ->join('categories','pitches.idCategory','=','categories.id')
        ->join('pitch_prices','pitch_prices.idCategory','=','categories.id')
        ->where('pitches.id',$pitchid_hidden)->get();

        foreach($pitchprice as $key =>$value){
            foreach($pitchdetail->orderDetails->where('pitch_date', $ngaysudung) as $order_detail) {
                if ($order_detail->pitch_date == $ngaysudung && $value->timeframe == $order_detail->pitch_timeframe) {
                    $pitchprice[$key]->status = 'Hết sân';
                    break;
                }
                else {
                    $pitchprice[$key]->status = 'Còn trống';
                }
            }
        }

        return response()->json($pitchprice);
    }
}
