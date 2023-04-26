<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
//use Maatwebsite\Excel\Facades\Excel;

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id)
        {
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
        $category_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
        return view('admin.add_category_product')->with(compact('category_product'));
    }
    public function all_category_product(){
        $all_category_product = DB::table('tbl_category_product')->get();
        $category_product = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        $manage_category_product =  view('admin.all_category_product')->with('all_category_product',$all_category_product)
            ->with('category_product',$category_product);

        return view('admin_layout')->with('admin.all_category_product',$manage_category_product);
    }
    public function save_category_product(Request $request){
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['category_des'] = $request->category_product_desc;
        $data['category_parent'] = $request->category_parent;
        $data['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    public function active_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    public function unactive_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    public function edit_category_product($category_product_id){
        $edit_category_product = \App\Models\CategoryProduct::where('category_id',$category_product_id)->orderby('category_id','desc')->get();
        $category_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
        $manage_category_product =  view('admin.edit_category_product')->with('edit_category_product',$edit_category_product)->with('category_product',$category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manage_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_des'] = $request->category_product_desc;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['category_parent'] = $request->category_parent;
        $data['meta_keywords'] = $request->meta_keywords;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    public function delete_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
    //End funtion admin page
    public function show_category_home($category_id,Request $request){
        $meta_desc = '';
        $meta_keywords = '';
        $meta_title = '';
        $giatri =0;
        $url_canonical = '';
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $category_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $category_by_id2=null;
        $check = true;
        if(isset($_GET['sort_by']))
        {
            $sort_by = $_GET['sort_by'];
            if($sort_by=='giam_dan')
            {
                $category_by_id2 = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
                    ->where('tbl_category_product.slug_category_product',$category_id)->orderBy('product_price','desc')
                    ->get();
            }elseif ($sort_by=='tang_dan')
            {
                $category_by_id2 = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
                    ->where('tbl_category_product.slug_category_product',$category_id)->orderBy('product_price','asc')
                    ->get();
            }elseif ($sort_by=='kytu_az')
            {
                $category_by_id2 = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
                    ->where('tbl_category_product.slug_category_product',$category_id)->orderBy('product_name','asc')
                    ->get();
            }elseif ($sort_by=='kytu_za')
            {
                $category_by_id2 = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
                    ->where('tbl_category_product.slug_category_product',$category_id)->orderBy('product_name','desc')
                    ->get();
            }
            else{
                $category_by_id2 = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
                    ->where('tbl_category_product.slug_category_product',$category_id)->orderBy('product_id','desc')
                    ->get();
            }
        }
        else{
            $category_by_id2 = Product::join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
                ->where('tbl_category_product.slug_category_product',$category_id)->orderBy('product_id','desc')
                ->get();
        }
//        echo $category_by_id2;
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            ->where('tbl_category_product.slug_category_product',$category_id)->get();
        foreach ($category_by_id as $key =>$val) {
            $meta_desc = $val->category_des;
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->category_name;
            $url_canonical = $request->url();
        }
        $cate_post = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        $partner = Partner::orderby('icon_id','asc')->get();
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->get();
        $number = round(($all_product->count())/10);
        Session::put('page_number',$number);
//        if($giatri>1)
//        {
//            $giatri+=3;
//            echo $giatri;
//            $all_product = DB::table('tbl_product')->where('product_status','0')->where('product_id','>=',$giatri*10+1)
//                ->where('product_id','<',($giatri+1)*10)->orderBy('product_id','desc')->get();
//        }
//        else{
//            $all_product = DB::table('tbl_product')->where('product_status','0')->where('product_id','>=',39)
//                ->where('product_id','<',50)->orderBy('product_id','desc')->get();
//        }
            $cate_name = DB::table('tbl_category_product')->where('tbl_category_product.slug_category_product',$category_id)->limit(1)->get();
        return view('pages.category.show_category')->with('cate_product',$category_product)->with('brand_product',$brand_product)->with('category_by_id',$category_by_id2)
            ->with('cate_name',$cate_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('slide',$slider)->with('category_product_pro',$category_product_pro)->with('cate_post',$cate_post)->with('category_by_id2',$category_by_id2)
            ->with('check',$check)->with('partner',$partner)->with('giatri',$giatri);
    }
    //import data
//    public function export_csv(){
//        return Excel::download(new ExcelExport , 'product.xlsx');
//    }
//
//    public function import_csv(Request $request){
//        $path = $request->file('file')->getRealPath();
//        Excel::import(new ExcelImport, $path);
//        return back();
//    }

}
