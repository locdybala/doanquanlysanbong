<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Pitch;
use App\Models\PitchPrice;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Cart;
use App\Models\Coupon;
use Darryldecode\Cart\Cart as CartCart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\PostCategory;
session_start();
class CartController extends Controller
{
    public function check_coupon(Request $request)
    {

        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if ($coupon) {
            $count_coupon = $coupon->count();
            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');
                if ($count_coupon == true) {
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon', $cou);
                    }
                } else {
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,

                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return redirect()->back()->with('success', 'Thêm mã giảm giá thành công');
            }
        } else {
            return redirect()->back()->with('message', 'Mã giảm giá không đúng');
        }
    }
    public function saveCart(Request $request)
    {
        $pitch_prices = $request->pitch_prices_id;
        $pitchid = $request->pitchid_hidden;
        $ngay_dat = $request->ngay_dat;
        $pitch_info = Pitch::find($pitchid);

        $pitchprice_info = PitchPrice::find($pitch_prices);
        // Cart::add('293ad', 'Product 1', 1, 9.99);

        $data['id'] = $pitch_info->id;
        $data['name'] = $pitch_info->name;
        $data['price'] = $pitchprice_info->price;
        $data['quantity'] = 1;
        $data['attributes']['image'] = $pitch_info->image;
        $data['attributes']['ngaydat'] = $ngay_dat;
        $data['attributes']['timeframe'] = $pitchprice_info->timeframe;
        Cart::add($data);

        return Redirect::to('/showcart');

        // $pitch_info=DB::table('pitches')
        // ->join('categories','pitches.idCategory','=','categories.id')
        // ->join('pitch_prices','pitch_prices.idCategory','=','categories.id')
        // ->where('pitches.id',$pitchid)
        // ->where('pitch_prices.id',$pitch_prices)->get();
    }
    public function showcart()
    {
        $postcategory=PostCategory::all();

        return view('frontend.cart.showcart',compact('postcategory'));
    }
    public function deletecart(Request $request)
    {

        \Cart::remove($request->id);

        Session::forget('coupon');


        return Redirect::to('/showcart')->with('success', 'Xóa giỏ hàng thành công');
    }

    public function delete_coupon()
    {
        Session::forget('coupon');
        return Redirect::to('/showcart')->with('success', 'Xóa mã khuyến mãi thành công');
    }
    public function delete_couponcheckout()
    {
        Session::forget('coupon');
        return Redirect::to('/checkout')->with('success', 'Xóa mã khuyến mãi thành công');
    }
}
