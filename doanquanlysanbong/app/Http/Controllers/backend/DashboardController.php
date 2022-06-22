<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Statistical;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function filter_by_date(Request $request){
        $data=$request->all();
        $form_date=$data['form_date'];
        $to_date=$data['to_date'];
        $get=Statistical::whereBetween('order_date',[$form_date,$to_date])->get();
        foreach($get as $val){
            $chart_data[]=array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
            );
        }
         echo $data=json_encode($chart_data);
    }
    public function dashboard_filter(Request $request){
        $data=$request->all();
        // $today=Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $dauthangnay=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();

        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value']=='7ngay'){
            $get=Statistical::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangtruoc'){
            $get=Statistical::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangnay'){
            $get=Statistical::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }else{
            $get=Statistical::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }
        foreach($get as $val){
            $chart_data[]=array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
            );
        }
         echo $data=json_encode($chart_data);

    }
    public function days_order(){
        $sub30days=Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get=Statistical::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();
        foreach($get as $val){
            $chart_data[]=array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity,
            );
        }
         echo $data=json_encode($chart_data);
    }
}
