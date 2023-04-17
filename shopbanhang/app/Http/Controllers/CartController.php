<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function save_cart(Request $request){
        $product_id = $request->product_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id',$product_id)->first();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
//        Cart::add('293ad', 'Product 1', 1, 9.99);
        $data['id']=$product_info->product_id;
        $data['qty']=$quantity;
        $data['name']=$product_info->product_name;
        $data['price']=$product_info->product_price;
        $data['weight']='123';
        $data['options']['image']=$product_info->product_image;
        Cart::add($data);
//        Cart::setGlobalTax(2);
        return Redirect::to('http://localhost:8080/shopbanhang/show-cart');
    }
    public function show_cart(){
        $meta_desc = '';
        $meta_keywords = '';
        $meta_title = '';
        $url_canonical = '';
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        return view('pages.cart.show_cart')->with('cate_product',$cate_product)->with('brand_product',$brand_product)
      ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);

    }
    public function  delete_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('http://localhost:8080/shopbanhang/show-cart');
    }
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $quantity = $request->cart_quantity;
        Cart::update($rowId,$quantity);
        return Redirect::to('http://localhost:8080/shopbanhang/show-cart');
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('newcart');
        if($cart==true)
        {
            $is_avaible = 0;
            foreach ($cart as $key =>$val)
            {
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaible++;
                }
            }
            if($is_avaible==0)
            {
                $cart[] = array(
                    'session_id'=>$session_id,
                    'product_name'=>$data['cart_product_name'],
                    'product_id'=>$data['cart_product_id'],
                    'cart_product_image'=>$data['cart_product_image'],
                    'product_quantity'=>$data['cart_product_quantity'],
                    'product_price'=>$data['cart_product_price'],
                    'product_qty'=>$data['cart_product_qty'],
                );
                Session::put('newcart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id'=>$session_id,
                'product_name'=>$data['cart_product_name'],
                'product_id'=>$data['cart_product_id'],
                'product_quantity'=>$data['cart_product_quantity'],
                'cart_product_image'=>$data['cart_product_image'],
                'product_price'=>$data['cart_product_price'],
                'product_qty'=>$data['cart_product_qty'],

            );
        }
        Session::put('newcart',$cart);
        Session::save();
    }
    public function gio_hang(Request $request){
        $meta_desc = 'Giỏ hàng ajax';
        $meta_keywords = 'Giỏ hàng ajax';
        $meta_title = 'Giỏ hàng ajax';
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        return view('pages.cart.cart_ajax')->with('cate_product',$cate_product)->with('brand_product',$brand_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('slide',$slider);
    }
    public function delete_sp($session_id){
        $cart = Session::get('newcart');
        if($cart==true)
        {
            foreach ($cart as $item=>$value) {
                if($value['session_id']==$session_id)
                {
                    unset($cart[$item]);
                }
            }
            Session::put('newcart',$cart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        }
        else{
            return redirect()->back()->with('message','Xóa sản phẩm thất bại');
        }
    }
    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('newcart');
        if($cart==true)
        {
            foreach ($data['cart_quantity'] as $key=>$qty) {
                foreach ($cart as $sessionid=> $item) {
                    if($item['session_id']==$key)
                    {
                        $cart[$sessionid]['product_qty']=$qty;
                    }
                }
            }
            Session::put('newcart',$cart);
            return redirect()->back()->with('message','Cập nhật sản phẩm thành công');
        }
    }
    public function del_all_product(){
        $cart = Session::get('newcart');
        if($cart==true)
        {
            Session::forget('newcart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa tất cả sản phẩm thành công');
        }
        else{
            return redirect()->back()->with('message','Xóa tất cả sản phẩm thành công');
        }
    }
    //coupon
    public function check_coupon(Request $request){
        $data = $request->all();
        print_r($data);
    }
}
