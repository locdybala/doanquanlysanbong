<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Pitch;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Social;
use App\Models\Visitor;
use Carbon\Carbon;
use Socialite; 
use Illuminate\Support\Facades\Auth;


session_start();
class LoginController extends Controller
{
    public function AuthLogin(){
        $adminId=Auth::id();
        if($adminId){
            return Redirect::to('admin');
        }
        else{
            return Redirect::to('admin/login')->send();
        }
    }
    public function index(Request $request)
    {
        $this->AuthLogin();
        $user_ip_address=$request->ip();
        $early_last_month=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_of_last_month=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $early_this_month=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $oneyears=Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        //total last month
        $visitoroflastmonth=Visitor::whereBetween('date_visitor',[$early_last_month,$end_of_last_month])->get();
        $visitoroflastmonth_count=$visitoroflastmonth->count();
        //total this month
        $visitorothismonth=Visitor::whereBetween('date_visitor',[$early_this_month,$now])->get();
        $visitorothismonth_count=$visitorothismonth->count();
        //total one year
        $visitorofyear=Visitor::whereBetween('date_visitor',[$oneyears,$now])->get();
        $visitorofyear_count=$visitorofyear->count();
        //Tổng truy cập
        $visitor=Visitor::all();
        $visitor_total=$visitor->count();
        $visitors_current=Visitor::where('ip_address',$user_ip_address)->get();
        $visitor_count=$visitors_current->count();
        if($visitor_count<1){
            $visitor=new Visitor();
            $visitor->ip_address=$user_ip_address;
            $visitor->date_visitor=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }
        $user=User::all();
        $user_count=$user->count();
        //
        $pitch=Pitch::all()->count();
        $post=Post::all()->count();
        $order=Order::all()->count();
        $customer=Customer::all()->count();

        $post_view=Post::orderBy('post_view','DESC')->take(10)->get();
        $pitch_view=Pitch::orderBy('pitch_view','DESC')->take(10)->get();


        return view('admin.dashbord',compact('visitor_count','user_count','visitor_total',
        'visitorothismonth_count','visitoroflastmonth_count','visitorofyear_count',
        'pitch','post','order','customer','post_view','pitch_view'
    ));
    }
    public function show_login()
    {
        return view('admin.login');
    }
    public function register()
    {
        return view('admin.register');
    }
    public function login(Request $request)
    {
        $data=$request->all();
        $admin_email = $data['email'];
        $admin_password = md5($data['password']);
        $login = DB::table('users')->where('email', $admin_email)->where('password', $admin_password)->first();
        // $login_count=$login->count();
        if ($login) {
            Session::put('admin_name', $login->name);
            Session::put('admin_id', $login->id);
            return Redirect::to('admin');
        } else {
            Session::put('message', 'Mật khẩu hoặc tài khoản không chính xác');
            return Redirect::to('admin/login');
        }
    }
    public function logout()
    {
        $this->AuthLogin();
                    Session::put('admin_name',null);
                    Session::put('admin_id',null);
        return Redirect::to('admin/login');
    }
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = User::where('id',$account->user)->first();
            Session::put('admin_name',$account_name->name);
 Session::put('admin_id',$account_name->id);
            return redirect('/admin')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $loc = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = User::where('email',$provider->getEmail())->first();

            if(!$orang){
                $orang = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'phone'=>'',
                    

                ]);
            }
            $loc->login()->associate($orang);
            $loc->save();

            $account_name = User::where('id',$account->user)->first();

            Session::put('admin_name',$account_name->name);
             Session::put('admin_id',$account_name->id);
            return redirect('/admin')->with('message', 'Đăng nhập Admin thành công');
        } 
    }




}
