<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function lien_he(Request $request){
        //cần thay dổi
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $meta_desc = "Chuyên bán những phụ kiện gym";
        $meta_keywords = "Thực phẩm chức năng";
        $meta_title = "Bổ sung năng lượng";
        $check = false;
        $giatri = 0;
        $url_canonical = $request->url();
        $partner = Partner::orderby('icon_id','asc')->get();
        //cate-post
        $cate_post = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $category_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
        $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
//        $all_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
//            ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->orderBy('tbl_product.category_id',"desc")->get();
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->get();
        return view('pages.lienhe.contact')->with('cate_product',$category_product)->with('brand_product',$brand_product)->with('all_product',$all_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('slide',$slider)->with('category_product_pro',$category_product_pro)->with('cate_post',$cate_post)
            ->with('check',$check)->with('partner',$partner)->with('giatri',$giatri);
    }
}
