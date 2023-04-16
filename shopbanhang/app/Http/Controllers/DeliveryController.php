<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function delivery(Request $request){
        $city = City::orderby('matp','ASC')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }
}
