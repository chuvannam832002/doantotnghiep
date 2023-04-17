<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
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
            $order_status = $item->order_status;
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
        return view('admin.view_order')->with(compact('order_detail','customer','shipping','order_detail_new','coupon_condition','coupon_number','order','order_status'));
    }
    public function update_order_qty(Request $request){
        $data = $request->all();
        $order=Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        if($order->order_status==2)
        {
            foreach ($data['order_product_id'] as $key=> $product_id) {
                $product =Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach ($data['quantity'] as $key2 => $qty) {
                    if($key2==$key)
                    {
                        $pro_remain = $product_quantity - $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold+$qty;
                        $product->save();
                        foreach ($data['order_detail_product_id'] as $key3 =>$o_d)
                        {
                            if($key3==$key)
                            {
                                $order_details = OrderDetails::find($o_d);
                                $order_details->product_sales_quantity=$qty;
                                $order_details->save();
                            }

                        }
                    }
                }
            }
        }
        else{
            foreach ($data['order_product_id'] as $key=> $product_id) {
                $product =Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach ($data['quantity'] as $key2 => $qty) {
                    if($key2==$key)
                    {
                        $pro_remain = $product_quantity + $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold-$qty;
                        $product->save();
                        foreach ($data['order_detail_product_id'] as $key3 =>$o_d)
                        {
                            if($key3==$key)
                            {
                                $order_details = OrderDetails::find($o_d);
                                $order_details->product_sales_quantity=$qty;
                                $order_details->save();
                            }
                        }

                    }
                }
            }
        }
    }
    public function update_qty(Request $request)
    {
        $data = $request->all();
        $order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();
    }
}
