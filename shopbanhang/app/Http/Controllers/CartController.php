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
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        return view('pages.cart.show_cart')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
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
}
