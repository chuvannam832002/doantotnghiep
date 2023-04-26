<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function list_coupon(){
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        Session::put('today',$now);
        $coupon = Coupon::orderby('coupon_id','DESC')->get();
        return view('admin.coupon.list_coupon')->with(compact('coupon','now'));
    }
    public function insert_coupon(){
return view('admin.coupon.insert_coupon');
    }
    public function insert_coupon_code(Request $request){
        $data = $request->all();
        if( Date::parse($data['coupon_date_start'])> Date::parse($data['coupon_date_end']))
        {
            Session::put('message','Ngày bắt đầu phải trước ngày kết thúc');
            return \redirect()->back();
        }
        else{
            $check = Coupon::where('coupon_code',$data['coupon_code'])->count();
            echo $check;
            if($check!=0)
            {
                Session::put('message','Đã tồn tại mã giảm giá');
                return \redirect()->back();
            }
            else{
                $today = Session::get('today');
                $coupon = new Coupon();
                if($data['coupon_date_end']<$today)
                {
                    $coupon->coupon_status = 1;
                }
                else{
                    $coupon->coupon_status = 0;
                }
                $coupon->coupon_name = $data['coupon_name'];
                $coupon->coupon_code = $data['coupon_code'];
                $coupon->coupon_time = $data['coupon_times'];
                $coupon->coupon_condition = $data['coupon_condition'];
                $coupon->coupon_date_start = $data['coupon_date_start'];
                $coupon->coupon_date_end = $data['coupon_date_end'];
                $coupon->coupon_number = $data['coupon_number'];
                $coupon->save();
                Session::put('message','Thêm mã giảm giá thành công');
                return Redirect::to('list-coupon');
            }

        }

    }
    public function delete_coupon($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('list-coupon');
    }
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon==true)
        {
            $count_coupon = $coupon->count();
            if($count_coupon>0)
            {
                if($coupon->coupon_status==0)
                {
                    if($coupon->coupon_used==0)
                    {
                        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
                        if($coupon->coupon_date_end>$today)
                        {
                            $coupon_session = Session::get('coupon');
                            if($coupon_session==true)
                            {
                                $is_avaiable=0;
                                if($is_avaiable==0)
                                {
                                    $cou[] = array(
                                        'coupon_code'=>$coupon->coupon_code,
                                        'coupon_condition'=>$coupon->coupon_condition,
                                        'coupon_number'=>$coupon->coupon_number,
                                    );
                                    Session::put('coupon',$cou);
                                }
                            }else{
                                $cou[] = array(
                                    'coupon_code'=>$coupon->coupon_code,
                                    'coupon_condition'=>$coupon->coupon_condition,
                                    'coupon_number'=>$coupon->coupon_number,
                                );
                                Session::put('coupon',$cou);
                            }
                            Session::save();
                            return \redirect()->back()->with('message','Giảm giá thành công');
                        }
                        else{
                            return \redirect()->back()->with('error','Mã giảm giá đã được sử dụng');
                        }
                    }
                    else{
                        return \redirect()->back()->with('error','Mã giảm giá đã hết hạn');
                    }

                }
                else{
                    return \redirect()->back()->with('error','Mã giảm giá đã hết hạn');
                }

            }
        }
        else{
            return \redirect()->back()->with('error','Mã Giảm giá không đúng');
        }
    }
    public function del_all_coupon(){
        $cart = Session::get('coupon');
        if($cart==true)
        {
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
        else{
            return redirect()->back()->with('message','Xóa tất cả sản phẩm thành công');
        }
    }
}
