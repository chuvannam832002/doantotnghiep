<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Customer;
use App\Models\Partner;
use App\Models\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function login_checkout(){
        $meta_desc = '';
        $meta_keywords = '';
        $meta_title = '';
        $check = false;   $giatri = 0;
        $url_canonical = '';
        $partner = Partner::orderby('icon_id','asc')->get();
        $cate_post = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $cate_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('meta_desc',$meta_desc)
            ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('slide',$slider)->with('category_product_pro',$category_product_pro)->with('cate_post',$cate_post)
            ->with('check',$check) ->with('partner',$partner)->with('giatri',$giatri);
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
        $checkid = Session::get('customer_id');
        $meta_desc = '';
        $meta_keywords = '';
        $meta_title = '';
        $url_canonical = '';
        $partner = Partner::orderby('icon_id','asc')->get();
        $check = false;
        $city = City::orderby('matp','asc')->get();
        $cate_post = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $cate_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
        if($checkid)
        {
            return view('pages.checkout.checkout')->with('cate_product',$cate_product)->with('brand_product',$brand_product)
                ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
                ->with('city',$city)->with('slide',$slider)->with('category_product_pro',$category_product_pro)->with('cate_post',$cate_post)
                ->with('check',$check) ->with('partner',$partner);
        }
        else{
            return Redirect('/login-checkout');
        }
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
        $meta_desc = '';
        $meta_keywords = '';
        $meta_title = '';
        $url_canonical = '';
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.payment')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function logout_checkout(){
        Session::flush();
//        Session::put('customer_id','');
        return Redirect('/login-checkout');
    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
        if ($result!=null)
        {
            Session::put('customer_id',$result->customer_id);
            return Redirect('/checkout');
        }
        else{
            return Redirect('/login-checkout');
        }

    }
    public function order_place(Request $request){
        //insert payment
        $data = array();
        $data['payment_status']=$request->payment_option;
        $data['payment_method']="Đang chờ xử lý";
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        //insert order
        $order_data = array();
        $order_data['customer_id']=Session::get('customer_id');
        $order_data['shipping_id']=Session::get('shipping_id');
        $order_data['payment_id']=$payment_id;
        $order_data['order_total']=Cart::total();
        $order_data['order_status']="Đang chờ xử lý";
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        //insert order details
        $content = Cart::content();
        foreach ($content as $v_content)
        {
            $order_details_data = array();
            $order_details_data['order_id']=$order_id;
            $order_details_data['product_id']=$v_content->id;
            $order_details_data['product_name']=$v_content->name;
            $order_details_data['product_price']=$v_content->price;
            $order_details_data['product_sales_quantity']=$v_content->qty;
            DB::table('tbl_order_details')->insert($order_details_data);
        }
        if($data['payment_status']==1)
        {
            echo '1';
        }elseif ($data['payment_status']==2)
        {
            $meta_desc = '';
            $meta_keywords = '';
            $meta_title = '';
            $url_canonical = '';
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
            Cart::destroy();
            return view('pages.checkout.handcash')->with('cate_product',$cate_product)->with('brand_product',$brand_product)
                ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
        }else{
            echo '3';
        }
        return Redirect('/');
    }
    public function manage_order(){
        $all_product = DB::table('tbl_order')->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->select('tbl_order.*','tbl_customers.customer_name')->orderBy('tbl_order.order_id','desc')->get();
        $manage_order =  view('admin.manage_order')->with('all_order',$all_product);
        return view('admin_layout')->with('admin.manage_order',$manage_order);
    }
    public function view_order($orderId)
    {
        $all_product = DB::table('tbl_order')
            ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
            ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
            ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')->first();
        $manage_order =  view('admin.view_order')->with('order_by_id',$all_product);
        return view('admin_layout')->with('admin.view_order',$manage_order);
    }
    public function delete_order($orderId){
        DB::table('tbl_order')->where('order_id',$orderId)->delete();
        Session::put('message','Xóa đơn hàng thành công');
        return \redirect()->back();
    }
    public function forget_pass(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $check = Session::get('customer_id');
        $meta_desc = '';
        $meta_keywords = '';
        $meta_title = '';   $giatri = 0;
        $url_canonical = '';
        $check = false;
        $city = City::orderby('matp','asc')->get();
        $partner = Partner::orderby('icon_id','asc')->get();
        $cate_post = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $cate_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();

            return view('pages.checkout.forgetpassword')->with('cate_product',$cate_product)->with('brand_product',$brand_product)
                ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
                ->with('city',$city)->with('slide',$slider)->with('category_product_pro',$category_product_pro)->with('cate_post',$cate_post)
                ->with('check',$check) ->with('partner',$partner)->with('giatri',$giatri);
    }
    public function recover_pass(Request $request)
    {
        $data = $request->all();
        $customer = $data['email_account'];
        $cus = Customer::where('customer_email',$customer)->first();
//        echo $cus;
        $newcustomer = Customer::find($cus->customer_id);
        $newcustomer->customer_password = md5('123456');
        $newcustomer->save();
        $meta_desc = '';
        $meta_keywords = '';   $giatri = 0;
        $meta_title = '';
        $check = false;       $partner = Partner::orderby('icon_id','asc')->get();
        $url_canonical = '';
        $cate_post = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $cate_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        Session::put('message','Mật khẩu mới của bạn là 123456');
        return view('pages.checkout.login_checkout')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('meta_desc',$meta_desc)
            ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('slide',$slider)->with('category_product_pro',$category_product_pro)->with('cate_post',$cate_post)
            ->with('check',$check) ->with('partner',$partner)->with('giatri',$giatri);
    }
}
