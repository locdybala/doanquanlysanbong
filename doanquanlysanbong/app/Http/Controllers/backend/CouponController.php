<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function managecoupon(){
        $today=Carbon::now('Asia/Ho_Chi_Minh')->format('Y/m/d   ');
        $coupons=Coupon::orderby('id','DESC')->get();
        return view('admin.coupon.index',compact('coupons','today'));
    }
    public function add_coupon(){
        return view('admin.coupon.add');
    }
    public function addCoupon(Request $request){
        Coupon::create([
            'coupon_name'=>$request->coupon_name,
            'coupon_times'=>$request->coupon_times,
            'coupondate_start'=>$request->coupondate_start,
            'coupondate_end'=>$request->coupondate_end,
            'coupon_code'=>$request->coupon_code,
            'coupon_condition'=>$request->coupon_condition,
            'coupon_number'=>$request->coupon_number,
        ]);
        Session::put('success','Thêm mã giảm giá thành công');
        return redirect()->route('managecoupon');
    }
    public function delete($id){
        Coupon::find($id)->delete();
        Session::put('success','Xóa mã giảm giá thành công');
        return redirect()->route('managecoupon');
    }
    public function send_coupon(){
        $customer_vip=Customer::where('customer_vip',1)->get();
        $now =Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail=" Mã khuyến mãi ngày".''.$now;
        $data=[];
        foreach($customer_vip as $vip){
            $data['email'][]=$vip->customer_email;
        }
        Mail::send('admin.coupon.sendcoupon',$data,function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
        });
        return redirect()->back()->with('success','Gửi mã khuyến mãi thành công');
    }
    public function mail_example(){
        return view('admin.coupon.sendcoupon');
    }
}
