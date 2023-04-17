<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
{
    public function manage_banner(){
        $slider = Slider::orderby('slider_id','desc')->get();
        return view('admin.slider.list_slider')->with(compact('slider'));
    }
    public function add_banner(){
        return view('admin.slider.add_slide');
    }
    public function save_banner(Request $request){
        $data = $request->all();

        $get_image = $request->file('slider_image');
        if($get_image)
        {
            $get_name_image =$get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $slider = new Slider();
            $slider->slider_name=$data['slider_name'];
            $slider->slider_image=$new_image;
            $slider->slider_status=$data['slider_status'];
            $slider->slider_desc=$data['slider_desc'];
            $slider->save();
            Session::put('message','Thêm Slide thành công');
            return Redirect::to('/add-slider');
        }
       else{
           Session::put('message','Làm ơn thêm hình ảnh ');
           return Redirect::to('/add-slider');
       }
    }
    public function active_banner($sliderid){
        DB::table('tbl_slider')->where('slider_id',$sliderid)->update(['slider_status'=>1]);
        Session::put('message','Active Slide thành công');
        return Redirect::to('/manage-slider');
    }
    public function unactive_banner($sliderid){
        DB::table('tbl_slider')->where('slider_id',$sliderid)->update(['slider_status'=>0]);
        Session::put('message','Unactive Slide thành công');
        return Redirect::to('/manage-slider');
    }
}
