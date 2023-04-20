<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
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
    public function add_product(){
        $this->AuthLogin();
        $meta_desc = '';
        $meta_keywords = '';
        $meta_title = '';
        $url_canonical = '';
//        $cate_product = DB::table('tbl_product')->orderBy('category_id','desc')->get();
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id','desc')->get();
//        $product = DB::table('tbl_product')->orderBy('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function all_product(){
        $all_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->orderBy('tbl_product.category_id',"desc")->get();
        $manage_product =  view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manage_product);
    }
    public function save_product(Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_des'] = $request->product_desc;
        $data['product_status'] = $request->product_status;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_sold'] = '0';
        $data['product_price'] = $request->product_price;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $get_image = $request->file('product_image');
        $new_image='';
        if($get_image)
        {
            $get_name_image =$get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('/all-product');
        }
        $data['product_image']='';
       $pro_id= DB::table('tbl_product')->insertGetId($data);
       $gallery = new Gallery();
       $gallery->gallery_image = $new_image;
       $gallery->product_id = $pro_id;
       $gallery->save();
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function active_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function unactive_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function edit_product($product_id){
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manage_product =  view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with(
            'brand_product',$brand_product
        );
        return view('admin_layout')->with('admin.edit_product',$manage_product);
    }
    public function update_product(Request $request,$product_id){
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
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('/all-product');
        }
        $data['product_image']='';
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    public function delete_product($product_id){
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('/all-product');
    }
    //end funtion admin
    public function detail_product($product_id){
        $detail_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_id',$product_id)->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderBy('product_id','desc')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $category_cate='';
        $category_id='';
        $product_name = '';
        foreach ($detail_product as $key=>$values)
        {
            $category_id = $values->category_id;
            $category_cate = $values->category_name;
            $product_name = $values->product_name;
        }
        $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        $category= \App\Models\CategoryProduct::where('category_id',$category_id)->get();
        $category_slug='';
        foreach ($category as $key)
        {
            $category_slug=$key->slug_category_product;
        }
        $gallery = Gallery::where('product_id',$product_id)->get();
        $cate_post = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        $meta_desc = '';
        $meta_keywords = '';
        $meta_title = $product_name;
        $url_canonical = '';
        $related_product = DB::table('tbl_product')->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
            ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->where('tbl_product.category_id',$category_id)
            ->whereNotIn('tbl_product.product_id',[$product_id])->get();

        return view('pages.sanpham.detail_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product)
            ->with('product_details',$detail_product)->with('relate',$related_product)->with('meta_desc',$meta_desc)
            ->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slide',$slider)
            ->with('cate_post',$cate_post)->with('category_product_pro',$category_product_pro)->with('all_product',$all_product)->with('category_name',$category_cate)
            ->with('gallery',$gallery)->with('category_id',$category_slug);
    }
    public function quick_view(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
//        $gallery = Gallery::where('product_id',$product_id)->get();
//        $output['product_gallery']='';
//        foreach ($gallery as $key=> $item) {
//            $output['product_gallery'].='<p><img width="100%" src="public/upload/product/'.$item->gallery_image.'"></p>';
//        }
        $output['product_name']=$product->product_name;
        $output['product_id']=$product->product_id;
        $output['product_desc']=$product->product_desc;
        $output['product_content']=$product->product_content;
        $output['product_price']=number_format($product->product_price,0,',','.').'VNĐ';
        $output['product_image']='<p><img width="100%" src="public/upload/product/'.$product->product_image.'"></p>';
        $output['product_quickview_value'] = '
                        <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">
                        <input type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">
                        <input type="hidden" value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">
                        <input type="hidden"  class="cart_product_quantity_'.$product->product_id.'" value="'.$product->product_quantity.'" />
                        <input type="hidden" value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">
                        <input type="hidden" value="1" class="cart_product_qty_'.$product->product_id.'">';
        echo json_encode($output);
    }
    public function load_comment(Request $request){
        $product_id =  $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->get();
        $output='';
        foreach ($comment as$key=> $item) {
            $output.= ' <div class="row style_comment">
                            <div class="col-md-2">
                                <img style="margin-top: 10px" width="80%" src="'.url('public/upload/product/iconuser.jpg').'" class="img img-responsive img-thumbnail">
                            </div>
                            <div class="col-md-10">
                                <p style="color: green">@'.$item->comment_name.'</p>
                                <p>'.$item->comment.'</p>

                            </div>
                        </div>';
        }
        echo $output;
    }
    public function send_comment(Request $request){
        $product_id =  $request->product_id;
        $comment_name =  $request->comment_name;
        $comment_content =  $request->comment_content;
        $comment = new Comment();
        $comment->comment_name = $comment_name;
        $comment->comment = $comment_content;
        $comment->comment_product_id = $product_id;
        $comment->save();
    }

}
