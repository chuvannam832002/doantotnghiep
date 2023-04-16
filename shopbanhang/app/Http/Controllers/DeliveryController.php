<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Feeship;
use App\Models\Province;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DeliveryController extends Controller
{
    public function delivery(Request $request){
        $city = City::orderby('matp','ASC')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    public function insert_delivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp= $data['city'];
        $fee_ship->fee_maqh= $data['province'];
        $fee_ship->fee_xaid= $data['wards'];
        $fee_ship->fee_ship= $data['feeship'];
        $fee_ship->save();
        return redirect('/delivery');
    }
    public function select_feeship(){
        $feeship = Feeship::orderby('fee_id','desc')->get();
        $output = '';
        $output.='<div class ="table-responsive">
<table class="table table-bordered">
<thread>
<tr>
<th>Tên thành phố</th>
<th>Tên quận huyện</th>
<th>Tên xã phường</th>
<th>Phí ship</th>
</tr>
</thread>
<tbody>
';
        foreach ($feeship as $key=>$fee)
        {


        $output.='
<tr>
<td>'.$fee->city->name_city.'</td>
<td>'.$fee->province->name_quanhuyen.'</td>
<td>'.$fee->wards->name_xaphuong.'</td>
<td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_ship,0,',','.',).'</td>
</tr>';}
    $output.='
</tbody>
</table>
';
        echo $output;
    }
    public function update_delivery(Request $request){
$data = $request->all();
$fee_ship =Feeship::find($data['feeship_id']);
$fee_value = rtrim($data['fee_value'],'.');
$fee_ship->fee_ship=$fee_value;
$fee_ship->save();
    }
    public function select_delivery(Request $request){
        $data = $request->all();
        if($data['action'])
        {
            $output = '';
            if($data['action']=='city')
            {
                $select_province = Province::where('matp',$data['matp'])->orderby('maqh','ASC')->get();
                $output = '<option value="0">----Chọn quận huyện----</option>';
                foreach ($select_province as $key=>$province)
                {
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }

            }
            else{
                $select_province = Wards::where('maqh',$data['matp'])->orderby('xaid','ASC')->get();
                $output = '<option value="0">----Chọn xã phường----</option>';
                foreach ($select_province as $key=>$province)
                {
                    $output.='<option value="'.$province->xaid.'">'.$province->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
    }
    public  function  calculator_fee(Request $request){
        $data = $request->all();
        if($data['matp'])
        {
            $feeship = Feeship::where('fee_matp',$data['matp'])
                ->where('fee_maqh',$data['maqh'])
                ->where('fee_xaid',$data['xaid'])->get();
            foreach ($feeship as $key=>$fee) {
                Session::put('fee',$fee->fee_ship);
                Session::save();
            }
        }
    }
    public function del_fee(){
        Session::forget('fee');
        return redirect()->back();
    }
    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action'])
        {
            $output = '';
            if($data['action']=='city')
            {
                $select_province = Province::where('matp',$data['matp'])->orderby('maqh','ASC')->get();
                $output = '<option value="0">----Chọn quận huyện----</option>';
                foreach ($select_province as $key=>$province)
                {
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }

            }
            else{
                $select_province = Wards::where('maqh',$data['matp'])->orderby('xaid','ASC')->get();
                $output = '<option value="0">----Chọn xã phường----</option>';
                foreach ($select_province as $key=>$province)
                {
                    $output.='<option value="'.$province->xaid.'">'.$province->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
    }
}
