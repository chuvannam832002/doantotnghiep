<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class GalleryController extends Controller
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
    public function add_gallery($product_id){
        $pro_id = $product_id;
        return view('admin.gallery.add_gallery')->with(compact('pro_id'));
    }
    public function select_gallery(Request $request){
        $product_id = $request->pro_id;
        $gallery = Gallery::where('product_id',$product_id)->get();
        $gallery_count = $gallery->count();
        $output = '
<form>
'.csrf_field().'
<table class="table table-hover">
                        <thead>
                        <tr>
                          <th>Thứ tự</th>
                            <th>Tên hình ảnh</th>
                            <th>Hình ảnh</th>
                            <th>Quản lý</th>
                        </tr>
                        </thead>
                        <tbody>';
        if($gallery_count>0)
        {
            $i=0;
            foreach ($gallery as $item=>$value) {
                $i++;
                $output.='<tr>
                            <td>'.$i.'</td>
                            <td contenteditable class="edit_gal_name" data-gal_id="'.$value->gallery_id.'">'.$value->gallery_name.'</td>
                            <td><img src="'.\url('/public/upload/product').'/'.$value->gallery_image.'" width="120" height="120">
                            <input type="file" class="file_image" style="width: 40%" data-gal_id="'.$value->gallery_id.'" accept="image/*"
                            name="file" id="file-'.$value->gallery_id.'"/>
                            </td>
                            <td>
                            <button type="button" data-gal_id="'.$value->gallery_id.'" class="btn btn-xs btn-danger delete-gallery">
                            Xóa
</button>
</td>
                        </tr>
                ';
            }
        }
        else{
            $output.='
            <tr>
                            <th colspan="4">Sản phẩm này chưa có thư viện ảnh</th>

                        </tr>
            ';
        }
        $output.='</tbody></table></form>';
        echo $output;
    }
    public function update_gallery(Request $request){
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if($get_image)
        {
                $get_name_image =$get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
                $gallery = Gallery::find($gal_id);
                $gallery->gallery_image = $new_image;
                $gallery->save();
            }
        echo $gal_id;
    }
    public function delete_gallery(Request $request){
        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
//        unlink('/public/upload/product'.$gallery->gallery_image);
        $gallery->delete();
    }
    public function update_gallery_name(Request $request){
        $gal_id = $request->gal_id;
        $gal_text= $request->gal_text;
        $gallery = Gallery::find($gal_id);
        $gallery->gallery_name=$gal_text;
        $gallery->save();
    }
    public function insert_gallery($pro_id,Request $request){
        $get_image = $request->file('file');
        if($get_image)
        {
            foreach ($get_image as $item) {
                $get_name_image =$item->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.rand(0,99).'.'.$item->getClientOriginalExtension();
                $item->move('public/upload/product',$new_image);
                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $pro_id;
                $gallery->save();
            }

        }
        Session::put('message','Thêm thư viện ảnh thành công');
        return \redirect()->back();
    }
}
