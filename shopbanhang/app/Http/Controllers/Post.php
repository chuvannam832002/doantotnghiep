<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Post extends Controller
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
    public function add_post(){
        $this->AuthLogin();
        $category_product = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        return view('admin.post.add_post')->with(compact('category_product'));
    }
    public function save_post(Request $request){
        $data = $request->all();
        $post = new \App\Models\Post();
        $post->post_title=$data['post_title'];
        $post->post_desc=$data['post_desc'];
        $post->post_content=$data['post_content'];
        $post->post_meta_desc=$data['post_meta_desc'];
        $post->post_meta_keywords=$data['post_meta_keywords'];
        $post->post_slug=$data['post_slug'];
        $post->cate_post_id=$data['cate_post_id'];
        $post->post_status=$data['post_status'];
        $get_image = $request->file('post_image');
        if($get_image)
        {
            $get_name_image =$get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $post->post_image = $new_image;
            $post->save();
            Session::put('message','Thêm bài viết thành công');
            return \redirect()->back();
        }
        else{
            Session::put('message','Làm ơn thêm hình ảnh');
            return \redirect()->back();
        }
    }
        public function all_post(){
        $this->AuthLogin();
            $category_product = \App\Models\Post::orderby('post_id')->paginate(10);
        return  view('admin.post.all_post')->with(compact('category_product'));
    }
    public function delete_post($post_id){
        $this->AuthLogin();
        $post = \App\Models\Post::find($post_id);
        $post_image = $post->post_image;
        if($post_image)
        {
            $path ='public/upload/product'.$post_image;
        }
            $post->delete();
        Session::put('message','Xóa bài viết thành công');
        return \redirect()->back();
    }
    public function danhmucbaiviet(Request $request,$post_slug){
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $category_post =\App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        $url_canonical = $request->url();
        $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        $meta_desc = "Chuyên bán những phụ kiện gym";
        $meta_keywords = "Thực phẩm chức năng";
        $meta_title = "Bổ sung năng lượng";
        $cate_id='';
        $giatri = 0;
        //cate-post
        $check = false;
        $partner = Partner::orderby('icon_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $category_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
        $cate_post = \App\Models\CategoryPost::where('cate_post_slug',$post_slug)->take(1)->first();
            $meta_desc = $cate_post->cate_post_desc;
            $meta_keywords = $cate_post->cate_post_slug;
            $meta_title = $cate_post->cate_post_name;
            $cate_id = $cate_post->cate_post_id;
        $post = \App\Models\Post::where('post_status',0)->where('cate_post_id',$cate_id)->get();
        return view('admin.baiviet.danhmucbaiviet')->with('cate_product',$category_product)->with('brand_product',$brand_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('slide',$slider)->with('cate_post',$category_post)->with('post',$post)->with('category_product_pro',$category_product_pro)   ->with('check',$check)
            ->with('partner',$partner)->with('giatri',$giatri);
    }
    public function baiviet(Request $request,$post_slug){
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','0')->take(4)->get();
        $category_post =\App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        $url_canonical = $request->url();
        $category_product_pro = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        $meta_desc = "Chuyên bán những phụ kiện gym";
        $meta_keywords = "Thực phẩm chức năng";
        $meta_title = "Bổ sung năng lượng";
        $cate_id='';
        $check = false;   $giatri = 0;
        //cate-post
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','0')->orderBy('brand_id','desc')->get();
        $category_product = \App\Models\CategoryProduct::where('category_parent',0)->orderby('category_id','desc')->get();
        $cate_post = \App\Models\CategoryPost::where('cate_post_slug',$post_slug)->take(1)->first();
        $post = \App\Models\Post::where('post_status',0)->where('post_slug',$post_slug)->take(1)->first();
        $meta_desc = $post->post_meta_desc;
        $meta_keywords = $post->post_meta_keywords;
        $meta_title = $post->post_title;
        $partner = Partner::orderby('icon_id','asc')->get();
        $cate_id = $post->cate_post_id;
        return view('admin.baiviet.baiviet')->with('cate_product',$category_product)->with('brand_product',$brand_product)
            ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)
            ->with('slide',$slider)->with('cate_post',$category_post)->with('post',$post)->with('category_product_pro',$category_product_pro)   ->with('check',$check)
            ->with('partner',$partner)->with('giatri',$giatri);
    }
    public function edit_post($post_id)
    {
        $post = \App\Models\Post::find($post_id);
        $category_product = \App\Models\CategoryPost::orderby('cate_post_id','desc')->get();
        return view('admin.post.edit_post')->with(compact('post','category_product'));
    }
    public function update_post($post_id,Request $request)
    {
        $data = $request->all();
        $post = \App\Models\Post::find($post_id);
        $post->post_title=$data['post_title'];
        $post->post_desc=$data['post_desc'];
        $post->post_content=$data['post_content'];
        $post->post_meta_desc=$data['post_meta_desc'];
        $post->post_meta_keywords=$data['post_meta_keywords'];
        $post->post_slug=$data['post_slug'];
        $post->cate_post_id=$data['cate_post_id'];
        $post->post_status=$data['post_status'];
        $get_image = $request->file('post_image');
        if($get_image)
        {
            $get_name_image =$get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $post->post_image = $new_image;

        }
        $post->save();
        Session::put('message','Cập nhật bài viết thành công');
        return \redirect()->back();
    }
}
