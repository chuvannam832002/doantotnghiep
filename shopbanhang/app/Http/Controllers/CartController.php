<?php

namespace App\Http\Controllers;

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
        Cart::setGlobalTax(2);
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
        $cart = Session::get('cart');
        if($cart==true)
        {
            $is_avaible = 0;
            foreach ($cart as $key =>$val)
            {
                if($val['product_id']==$data['product_id']){
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
                    'product_price'=>$data['cart_product_price'],

                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id'=>$session_id,
                'product_name'=>$data['cart_product_name'],
                'product_id'=>$data['cart_product_id'],
                'cart_product_image'=>$data['cart_product_image'],
                'product_price'=>$data['cart_product_price'],

            );
        }
        Session::put('cart',$cart);
        Session::save();
        print_r($data);
    }
}
