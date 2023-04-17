<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request){
        //cần thay dổi
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $meta_desc = "Chuyên bán những phụ kiện gym";
        $meta_keywords = "Thực phẩm chức năng";
        $meta_title = "Bổ sung năng lượng";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
//        $all_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
//            ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->orderBy('tbl_product.category_id',"desc")->get();
              $all_product = DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->get();
        return view('pages.home')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('all_product',$all_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('slide',$slider);
    }
    public function search(Request $request){
        $keywords = $request->keywords_submit;
        echo $keywords;
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
//        $all_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
//            ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->orderBy('tbl_product.category_id',"desc")->get();
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->get();
        $search_product =  DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        return view('pages.sanpham.search')->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('product_search',$search_product);
    }
}
