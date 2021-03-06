<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Shipping;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use PDF;

class ManagerOrderController extends Controller
{
    public function manageorder()
    {
        $orders = Order::orderby('id', 'DESC')->paginate(5);

        return view('admin.order.manage_order', compact('orders'));
    }
    public function view_order($order_code)
    {
        $order_details = Order_detail::where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach ($order as $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('id', $customer_id)->first();
        $shipping = Shipping::where('id', $shipping_id)->first();
        foreach ($order_details as $key => $ord) {
            $pitch_coupon = $ord->pitch_coupon;
        }
        if ($pitch_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $pitch_coupon)->first();
            $coupon_number = $coupon->coupon_number;
            $coupon_condition = $coupon->coupon_condition;
        } else {
            $coupon_number = 0;
            $coupon_condition = 2;
        }

        return view('admin.order.view_order', compact('order_details', 'customer', 'shipping', 'order','coupon_number', 'coupon_condition'));
    }
    public function print_order($check_code)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($check_code));
        return $pdf->stream();
    }
    public function print_order_convert($check_code)
    {
        $order_details = Order_detail::where('order_code', $check_code)->get();
        $order = Order::where('order_code', $check_code)->get();
        foreach ($order as $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('id', $customer_id)->first();
        $shipping = Shipping::where('id', $shipping_id)->first();
        foreach ($order_details as $key => $ord) {
            $pitch_coupon = $ord->pitch_coupon;
        }
        if ($pitch_coupon != 'no') {
            $coupon = Coupon::where('coupon_code', $pitch_coupon)->first();
            $coupon_number = $coupon->coupon_number;
            $coupon_condition = $coupon->coupon_condition;
            if($coupon_condition==1){
                $coupon_echo=$coupon_number.'%';
            }
            elseif($coupon_condition==2){
                $coupon_echo =  number_format($coupon_number).'vn??';
            }
        } else {
            $coupon_number = 0;
            $coupon_condition = 2;
           
                $coupon_echo=0;
           
        }
        $output = '';
        $output = '<style>
            body{
                font-family:DejaVu Sans;
            }
        </style>
        <div style="text-align:center;margin:20px">
            <h3> <center>S??N B??NG PH??NG X??</center></h3>
            <h4>?????a ch???: Th??n 9 Ph??ng X?? Th???ch Th???t H?? N???i</h4>
            
                    <h5>Li??n h??? ?????t s??n</h5>
                    <p>0366280440</p>
                
            <h2>H??A ????N</h2>
        </div>
        <p>T??n kh??ch h??ng:'.$shipping->shipping_name.'</p>
        <p>S??? ??i???n tho???i:'.$shipping->shipping_phone.'</p>
        <p>?????a ch???:'.$shipping->shipping_address.'</p>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
               <th>ID</th>
                <th>T??n s???n ph???m</th>
                <th>M?? gi???m gi??</th>
                <th>Khung gi???</th>
                <th>Ng??y s??? d???ng</th>
                <th>G??a ti???n</th>

                </tr>
            </thead>
            <tbody>';
            $total=0;
    
            foreach($order_details as $key =>$order_detail){
                $subtotal=$order_detail->pitch_price;
                $total+=$subtotal;
                if ($order_detail->pitch_coupon!='no'){
                    $pitch_coupon=$order_detail->pitch_coupon ;

                }
                                    else{
                                      $pitch_coupon='  Kh??ng c?? m??';
                                    }
                                    
                    
                $output.='
                    <tr>
                        <td>1</td>
                        <td>'.$order_detail->pitch_name.'</td>
                        <td>'.$pitch_coupon.'</td>
                        <td>'.$order_detail->pitch_timeframe.'</td>
                        <td>'.$order_detail->pitch_date.'</td>
                        <td>'.$order_detail->pitch_price.'</td>


                    </tr>
                ';
            }
            if ($coupon_condition==1){
                $total_aftercoupon=($total*$coupon_number)/100;
                $total_coupon=$total-$total_aftercoupon;
            }
            else{
                $total_coupon=($total-$coupon_number);

            }
            $output.='<tr >
                <td colspan="2">
                    <p>T???ng gi???m:'.$coupon_echo.'</p>
                    <p>Thanh to??n: '.number_format($total_coupon).'</p>

                </td>
            </tr>';
            $output.='  
            </tbody>
        </table>';
        $output.='
        <p>K?? t??n</p>
        <table>
            <thead>
            <tr>
                <th width="200px">Ng?????i l???p phi???u</th>
                <th width="800px">Ng?????i ?????t</th>
                </tr>
            </thead>
           
        </table>
        ';
        return $output;
    }
    public function update_order(Request $request){
        $data=$request->all();
        $order=Order::find($data['order_id']);
        $order->order_status=$data['order_status'];
        $order->save();
    }
}
