<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Partner;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BrandProduct extends Controller
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
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){
//        $all_brand_product = DB::table('tbl_brand_product')->get();
        $all_brand_product = Brand::orderBy('brand_id','DESC')->get();
        $manage_brand_product =  view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product',$manage_brand_product);
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = $request->all();
//        $data = array();
        $brand = new Brand();
        $brand->brand_name =$data['brand_product_name'];
        $brand->brand_des =$data['brand_product_desc'];
        $brand->brand_status =$data['brand_product_status'];
        $brand->save();
        //        $data['brand_name'] = $request->brand_product_name;
//        $data['brand_des'] = $request->brand_product_desc;
//        $data['brand_status'] = $request->brand_product_status;
//        DB::table('tbl_brand_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
    public function active_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();
        $manage_brand_product =  view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$manage_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id){
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_des'] = $request->brand_product_desc;
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
    //End funtion admin page
    public function show_brand_home($brand_id){
        $meta_desc = '';
        $meta_keywords = '';
        $meta_title = '';
        $url_canonical = '';
        $giatri = 1;
        $check = false;
        $partner = Partner::orderby('icon_id','asc')->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $cate_post = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        $category_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $cate_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id',$brand_id)->limit(1)->get();
        if(isset($_GET['pages']))
        {
            $giatri = $_GET['pages'];
            $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
                ->where('tbl_product.brand_id',$brand_id)->get();
            $number = round(($brand_by_id->count())/10);
            Session::put('page_number',$number);
            if($giatri>1)
            {
                $giatri+=3;
                $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
                    ->where('tbl_product.brand_id',$brand_id)->where('product_id','>=',$giatri*10+1)
                    ->where('product_id','<',($giatri+1)*10)->get();
            }
            else{

                $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
                    ->where('tbl_product.brand_id',$brand_id)->where('product_status','0')->where('product_id','>=',39)
                    ->where('product_id','<',50)->get();
            }
        }
        else{
            $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
                ->where('tbl_product.brand_id',$brand_id)->paginate(10);
        }
        return view('pages.brand.show_brand')->with('cate_product',$category_product)->with('brand_product',$brand_product)->with('category_by_id',$brand_by_id)
            ->with('cate_name',$cate_name)
            ->with('cate_name',$cate_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('category_product_pro',$category_product_pro)->with('cate_post',$cate_post)  ->with('slide',$slider)   ->with('check',$check)->with('partner',$partner)
            ->with('giatri',$giatri);

    }
}
