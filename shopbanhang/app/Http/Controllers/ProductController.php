<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function add_product(){
        $cate_product = DB::table('tbl_product')->orderBy('category_id','desc')->get();
        $product = DB::table('tbl_product')->orderBy('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product)->with('product',$product);
    }
    public function all_product(){
        $all_product = DB::table('tbl_product')->get();
        $manage_product =  view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manage_product);
    }
    public function save_product(Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_des'] = $request->product_desc;
        $data['product_status'] = $request->product_status;
        $data['product_price'] = $request->product_price;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $get_image = $request->file('product_image');
        if($get_image)
        {
            $get_name_image =$get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('/add-product');
        }
        $data['product_image']='';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('/add-product');
    }
    public function active_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-product-product');
    }
    public function unactive_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-product-product');
    }
    public function edit_product($product_id){
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manage_product =  view('admin.edit_product')->with('edit_product',$edit_product);
        return view('admin_layout')->with('admin.edit_product',$manage_product);
    }
    public function update_product(Request $request,$product_id){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_des'] = $request->product_desc;
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/all-product-product');
    }
    public function delete_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('/all-product-product');
    }
}