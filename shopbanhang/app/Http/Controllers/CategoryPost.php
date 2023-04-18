<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryPost extends Controller
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
    public function add_cate_post(){
        $this->AuthLogin();
        $category_product = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        return view('admin.category_post.add_category');
    }
    public function save_cate_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $cate_post = new \App\Models\CategoryPost();
        $cate_post->cate_post_name=$data['cate_post_name'];
        $cate_post->cate_post_status=$data['cate_post_status'];
        $cate_post->cate_post_slug=$data['cate_post_slug'];
        $cate_post->cate_post_desc=$data['cate_post_desc'];
        $cate_post->save();
        Session::put('message','Thêm bài viết thành công');
        return \redirect()->back();
    }
    public function all_cate_post(){
        $all_category_product = DB::table('tbl_category_product')->get();
        $category_product = \App\Models\CategoryPost::orderby('cate_post_id','desc')->paginate(5);
        return  view('admin.category_post.all_cate_post')->with(compact('category_product'));
    }
    public function danh_muc_bai_viet($cate_post_slug){

    }
    public function edit_category_post($cate_post_id){
        $cate_post = \App\Models\CategoryPost::find($cate_post_id);
        return view('admin.category_post.edit_cate_post')->with(compact('cate_post'));
    }
    public function update_cate_post(Request $request,$cate_post_id)
    {
        $data = $request->all();
        $cate_post = \App\Models\CategoryPost::find($cate_post_id);
        $cate_post->cate_post_name=$data['cate_post_name'];
        $cate_post->cate_post_status=$data['cate_post_status'];
        $cate_post->cate_post_slug=$data['cate_post_slug'];
        $cate_post->cate_post_desc=$data['cate_post_desc'];
        $cate_post->save();
        Session::put('message','Cập nhật bài viết thành công');
        return \redirect()->back();
    }
    public function delete_cate_post($cate_post_id){
        $cate = \App\Models\CategoryPost::find($cate_post_id);
        $cate->delete();
        Session::put('message','Xóa bài viết thành công');
        return \redirect('/all-cate-post');
    }
}
