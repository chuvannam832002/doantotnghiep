<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function manage_order(){
        $order = Order::orderby('created_at','DESC')->get();
        return view('admin.manage_order')->with(compact('order'));
    }
    public function view_order($ordercode){
        $order_detail= OrderDetails::where('order_code',$ordercode)->get();
        $order= Order::where('order_code',$ordercode)->get();
        foreach ($order as $item) {
            $customer_id = $item->customer_id;
            $shipping_id = $item->shipping_id;
        }
        $order_detail_new = OrderDetails::with('product')->where('order_code',$ordercode)->get();
        $product_coupon='';
        foreach ($order_detail_new as $key=>$or_d)
        {
            $product_coupon=$or_d->product_coupon;
        }
        $coupon = Coupon::where('coupon_code',$product_coupon)->first();
        if($coupon)
        {
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        }
       else{
           $coupon_condition = 2;
           $coupon_number = 0;
       }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        return view('admin.view_order')->with(compact('order_detail','customer','shipping','order_detail_new','coupon_condition','coupon_number'));
    }
}
