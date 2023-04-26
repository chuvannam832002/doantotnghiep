<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Partner;
use App\Models\Shipping;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function count_cart(){
        $output = '';
        $giatri = Session::get('number');
//        if($giatri>0)
//        {
            $output.=' <a href="'.url('/gio-hang').'"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                            <span class="badges" style="background: red;padding: 5px;border-radius: 10px;font-size: 14px;
                            font-weight: bold;color: #fff">'.$giatri.'</span></a>';
//            $giatri++;
//            Session::put('number',$giatri);
//        }
//        else{
//            $output.=' <a href="'.url('/gio-hang').'"><i class="fa fa-shopping-cart"></i> Giỏ hàng
//                            <span class="badges" style="background: red;padding: 5px;border-radius: 10px;font-size: 14px;
//                            font-weight: bold;color: #fff">0</span></a>';
//            $giatri++;
//            Session::put('number',$giatri);
//        }
        echo $output;
    }
    public function new_count_cart(){
        $output = '';
        $giatri = Session::get('number');
        $giatri++;
        $output.=' <a href="'.url('/gio-hang').'"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                            <span class="badges" style="background: red;padding: 5px;border-radius: 10px;font-size: 14px;
                            font-weight: bold;color: #fff">'.$giatri.'</span></a>';
        Session::put('number',$giatri);
        echo $output;
    }
    public function index(Request $request){
        //cần thay dổi
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $meta_desc = "Chuyên bán những phụ kiện gym";
        $meta_keywords = "Thực phẩm chức năng";
        $meta_title = "Bổ sung năng lượng";
        $url_canonical = $request->url();
        $check = false;
        $giatri=1;
        if(isset($_GET['pages']))
        {
            $giatri = $_GET['pages'];
            $all_product = DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->get();
            $number = round(($all_product->count())/10);
            Session::put('page_number',$number);
            if($giatri>1)
            {
                $giatri+=3;
                echo $giatri;
                $all_product = DB::table('tbl_product')->where('product_status','0')->where('product_id','>=',$giatri*10+1)
                    ->where('product_id','<',($giatri+1)*10)->orderBy('product_id','desc')->get();
            }
            else{
                $all_product = DB::table('tbl_product')->where('product_status','0')->where('product_id','>=',39)
                    ->where('product_id','<',50)->orderBy('product_id','desc')->get();
            }
        }
        else{
            $all_product = DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->paginate(10);
        }
//        echo $all_product;
        $partner = Partner::orderby('icon_id','asc')->get();
        //cate-post
        $cate_post = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $category_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
        $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        $category_pro_tab = \App\Models\CategoryProduct::where('category_parent','<>',0)->orderby('category_id','asc')->get();


        return view('pages.home')->with('cate_product',$category_product)->with('brand_product',$brand_product)->with('all_product',$all_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('slide',$slider)->with('category_product_pro',$category_product_pro)->with('cate_post',$cate_post)->with('category_pro_tab',$category_pro_tab)
            ->with('check',$check)->with('partner',$partner)->with('giatri',$giatri);
    }
    public function search(Request $request){
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $meta_desc = "Chuyên bán những phụ kiện gym";
        $meta_keywords = "Thực phẩm chức năng";
        $meta_title = "Bổ sung năng lượng";
        $url_canonical = $request->url();
        $check = false;$partner = Partner::orderby('icon_id','asc')->get();
        //cate-post
        $giatri=0;
        $cate_post = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        $category_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
        $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->get();
        if(isset($_GET['pages']))
        {
            $giatri = $_GET['pages'];
            $search_product =  DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
            $number = round(($search_product->count())/10);
            Session::put('page_number',$number);
            if($giatri>1)
            {
                $giatri+=3;
                $search_product =  DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')
                    ->where('product_id','>=',$giatri*10+1)
                    ->where('product_id','<',($giatri+1)*10)->get();

            }
            else{
                $search_product =  DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')
                    ->where('product_id','>=',39)
                    ->where('product_id','<',50)->get();

            }
        }
        else{
            $search_product =  DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->paginate(25);
        }
        return view('pages.sanpham.search')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('product_search',$search_product)
            ->with('all_product',$all_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('slide',$slider)->with('category_product_pro',$category_product_pro)->with('cate_post',$cate_post) ->with('check',$check)
            ->with('partner',$partner)->with('giatri',$giatri);
    }
    public function history(Request $request){
        if(!Session::get('customer_id'))
        {
            return redirect('login-checkout')->with('error','Vui lòng đăng nhập để xem lịch sử giao hàng');
        }
        else{
            $keywords = $request->keywords_submit;
            echo $keywords;
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
            $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
            $meta_desc = "Lịch sử đơn hàng";
            $meta_keywords = "Lịch sử đơn hàng";
            $meta_title = "Lịch sử đơn hàng";
            $url_canonical = $request->url();
            $check = false;
            //cate-post
            $cate_post = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
            $category_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
            $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
            $all_product = DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->get();
            $search_product =  DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
            $getorder = Order::where('customer_id',Session::get('customer_id'))->orderby('order_id','desc')->paginate(10);
            return view('pages.history.history')->with(compact('getorder'))
                ->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('product_search',$search_product)
                ->with('all_product',$all_product)
                ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
                ->with('slide',$slider)->with('category_product_pro',$category_product_pro)->with('cate_post',$cate_post) ->with('check',$check);
        }
    }
    public function view_history_order(Request $request,$ordercode){
        if(!Session::get('customer_id'))
        {
            return redirect('login-checkout')->with('error','Vui lòng đăng nhập để xem lịch sử giao hàng');
        }
        else{
            $keywords = $request->keywords_submit;
            echo $keywords;
            $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
            $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
            $meta_desc = "Lịch sử đơn hàng";
            $meta_keywords = "Lịch sử đơn hàng";
            $meta_title = "Lịch sử đơn hàng";
            $url_canonical = $request->url();
            $check = false;
            //cate-post
            $cate_post = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
            $category_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
            $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
            $all_product = DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->get();
            $search_product =  DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
            $getorder = Order::where('customer_id',Session::get('customer_id'))->orderby('order_id','desc')->paginate(10);
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
            return view('pages.history.view_history_order')->with(compact('getorder'))
                ->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('product_search',$search_product)
                ->with('all_product',$all_product)
                ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
                ->with('slide',$slider)->with('category_product_pro',$category_product_pro)->with('cate_post',$cate_post) ->with('check',$check)
                ->with(compact('order_detail','customer','shipping','order_detail_new','coupon_condition','coupon_number','order','order_status'));
        }
    }
}
