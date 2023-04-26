<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PartnerController extends Controller
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
    public function add_partner(){
        $this->AuthLogin();
        $category_product = \App\Models\CategoryProduct::orderby('category_id','desc')->get();
        return view('admin.partner.add_partner');
    }
    public function all_partner(){
        $this->AuthLogin();
        $all_partner = Partner::orderby('icon_id','desc')->get();
        return view('admin.partner.all_partner')->with(compact('all_partner'));
    }
    public function edit_partner($icon_id)
    {
        $partner = Partner::find($icon_id);
        return view('admin.partner.edit_partner')->with(compact('partner'));
    }
    public function delete_partner($icon_id)
    {
        $partner = Partner::find($icon_id);
        $partner->delete();
        Session::put('message','Xóa đối tác thành công');
        return \redirect()->back();
    }
    public function update_partner($icon_id,Request $request)
    {
        $data = $request->all();
        $get_image = $request->file('file');
        $partner = Partner::find($icon_id);
        $partner->name = $data['name'];
        $partner->link = $data['link'];
        if($get_image)
        {
            $get_name_image =$get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $partner->image=$new_image;

        }
        $partner->save();
        Session::put('message','Cập nhật đối tác thành công');
        return \redirect()->back();
    }
    public function save_partner(Request $request){
        $get_image = $request->file('file');
        $data = $request->all();
        $partner = new Partner();
        $partner->name = $data['name'];
        $partner->link = $data['link'];
        if($get_image)
        {
            $get_name_image =$get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $partner->image = $new_image;
            $partner->save();
            Session::put('message','Thêm đối tác thành công');
            return \redirect()->back();
        }

    }
}
