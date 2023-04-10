<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function login_checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name']=$request->customer_name;
        $data['customer_email']=$request->customer_email;
        $data['customer_password']=md5($request->customer_password);
        $data['customer_phone']=$request->customer_phone;
        $insert_customer = DB::table('tbl_customers')->insertGetId($data);
        Session::put('customer_id',$insert_customer);
        Session::put('customer_name',$request->customer_name);
        return Redirect('/checkout');
    }
    public function checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.checkout')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
    }
    public function save_checkout_customer(Request $request){
        $admin_id = Session::get('customer_id');
        $data = array();
        $data['shipping_name']=$request->shipping_name;
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_address']=$request->shipping_address;
        $data['shipping_phone']=$request->shipping_phone;
        $data['shipping_note']=$request->shipping_note;
        $data['customer_id']=$admin_id;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        return Redirect('/payment');
    }
    public function payment(){

    }
    public function logout_checkout(){
        Session::flash();
        return Redirect('/login-checkout');
    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
        Session::put('customer_id',$result->customer_id);

        if ($result)
        {
            return Redirect('/checkout');

        }
        else{
            return Redirect('/login-checkout');

        }
    }
}
