<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Cart;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\PostCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{

    public function confirm_order(Request $request)
    {

        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->id;
        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);
        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = '1';
        $order->order_code = $checkout_code;
        $order_date=Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->order_date=$order_date;
        $order->save();

        $order_details = new Order_detail();

        $content = Cart::getContent();
        foreach ($content as $vcontent) {
            $order_details->order_code = $checkout_code;
            $order_details->pitch_id = $vcontent->id;
            $order_details->pitch_name = $vcontent->name;
            $order_details->pitch_date = $vcontent->attributes->ngaydat;
            $order_details->pitch_timeframe = $vcontent->attributes->timeframe;
            $order_details->pitch_price = $vcontent->price;
            $order_details->pitch_coupon = $data['order_coupon'];
            $order_details->save();
        }
        Session::forget('coupon');
        \Cart::clear();

    }
    public function login_checkout()
    {
        $postcategory=PostCategory::all();

        return view('frontend.checkout.login_checkout',compact('postcategory'));
    }
    public function register()
    {
        $postcategory=PostCategory::all();

        return view('frontend.checkout.register',compact('postcategory'));
    }
    public function add_customer(Request $request)
    {
        $postcategory=PostCategory::all();
        $data = array();
       


        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_address'] = $request->customer_address;

        $file = $request->file('customer_image');
        if ($file) {
            $getnameimage = $file->getClientOriginalName();
            $nameimage = current(explode('.', $getnameimage));
            $new_image = $nameimage . rand(0, 99) . '.' . $file->getClientOriginalExtension();
            $file->move('upload/customer', $new_image);
            $data['customer_image'] = $new_image;
            $customerid = Customer::insertGetId($data);
            Session::put('customer_id', $customerid);
            Session::put('customer_name', $request->customer_name);

            return redirect()->route('checkout');
        }
        $data['image'] = '';
        $customerid = Customer::insertGetId($data);
        Session::put('customer_id', $customerid);
        Session::put('customer_name', $request->customer_name);
        return redirect()->route('checkout');
    }
    public function checkout()
    {
        $postcategory=PostCategory::all();

        return view('frontend.checkout.checkout',compact('postcategory'));
    }
    public function logout_checkout()
    {
        $postcategory=PostCategory::all();

        Session::flush();
        return redirect()->route('login_checkout',compact('postcategory'));
    }
    public function login_customer(Request $request)
    {
        $customer_email = $request->customer_email;
        $customer_password = md5($request->customer_password);
        $result = DB::table('customers')->where('customer_email', $customer_email)
            ->where('customer_password', $customer_password)->first();
        if ($result) {
            Session::put('customer_id', $result->id);
            return redirect()->route('checkout');
        } else {
            Session::put('message', 'Tài khoản hoặc mật khẩu không chính xác');

            return redirect()->route('login_checkout');
        }
    }
    public function savecheckout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = md5($request->shipping_address);
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_notes'] = $request->shipping_notes;
        $shippingid = Shipping::insertGetId($data);
        Session::put('shipping_id', $shippingid);
        return redirect()->route('payment');
    }
    public function payment()
    {
        return view('frontend.checkout.payment');
    }
    public function order_place(Request $request)
    {

        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment = Payment::insertGetId($data);

        $orderdata = array();
        $orderdata['customer_id'] = Session::get('customer_id');
        $orderdata['shipping_id'] = Session::get('shipping_id');
        $orderdata['payment_id'] = $payment;
        $orderdata['order_total'] = \Cart::getTotal(0, ',', '.');
        $orderdata['order_status'] = 'Đang chờ xử lý';
        $orderid = Order::insertGetId($orderdata);

        $content = Cart::getContent();
        foreach ($content as $vcontent) {
            $orderdetail = array();
            $orderdetail['order_id'] = $orderid;
            $orderdetail['pitch_id'] = $vcontent->id;
            $orderdetail['pitch_name'] = $vcontent->name;
            $orderdetail['pitch_date'] = $vcontent->attributes->ngaydat;
            $orderdetail['pitch_timeframe'] = $vcontent->attributes->timeframe;
            $orderdetail['pitch_price'] = $vcontent->price;
            $result = Order_detail::insert($orderdetail);
        }
        if ($data['payment_method'] == 1) {
            \Cart::clear();
            return view('frontend.checkout.handcash');
        } else {
            echo 'Thanh toán online';
        }
        // return redirect()->route('payment');
    }
    public function quenmatkhau(){
        $postcategory=PostCategory::all();
        return view('frontend.checkout.forget_password',compact('postcategory'));
    }
    public function recover_pass(Request $request){
        $data=$request->all();
        $now=Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail="Lấy lại mật khẩu".''.$now;
        $customer=Customer::where('customer_email','=',$data['customer_email'])->get();
        foreach($customer as $key){
            $customer_id=$key->id;
        }
        if($customer){
            $count_customer=$customer->count();
            if($count_customer==0){
                return redirect()->back()->with('message','Email chưa được đăng ký để khôi phục mật khẩu');
            }else{
                $token_random=Str::random();
                $customer=Customer::find($customer_id);
                $customer->customer_token=$token_random;
                $customer->save();
                $to_email=$data['customer_email'];
                $linkresetpass=url('/update-new-pass?email='.$to_email.'&token='.$token_random);

                $data=array("name"=>$title_mail,"body"=>$linkresetpass,'email'=>$data['customer_email']);
                Mail::send('frontend.checkout.resetpass',['data'=>$data],function($message) use ($title_mail,$data){
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($data['email'],$title_mail);
                });
                return redirect()->back()->with('message','Gửi mail thành công vui lòng  truy cập vào gmail để reset password');            }
        }
    }
    public function update_new_pass(Request $request){
        $postcategory=PostCategory::all();
        return view('frontend.checkout.newpass',compact('postcategory'));
    }
    public function reset_newpass(Request $request){
        $data=$request->all();
        $token_random=Str::random();
        $customer=Customer::where('customer_email','=',$data['email'])->where('customer_token','=',$data['token'])->get();
        $count=$customer->count();
        if($count>0){
            foreach($customer as $key){
                $customer_id=$key->id;
            }
            $reset=Customer::find($customer_id);
            $reset->customer_password=md5($data['customer_password']);
            $reset->customer_token=$token_random;
            $reset->save();
            return redirect('login_checkout')->with('success','Mật khẩu đã được cập nhập. Quay lại trang đăng nhập');
        }else{
            return redirect('quenmatkhau')->with('message','Vui lòng nhập lại email vì link đã quá hạn');
        }
    }
}
