<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'product_name','category_id','brand_id','product_des','product_content','product_price','product_image',
        'product_status'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
    public function category(){
        return $this->belongsTo('App\Models\CategoryProduct','category_id');
    }
}
