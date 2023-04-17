<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'meta_keywords','category_name','slug_category_product','category_des','category_status'
    ];
    protected $primaryKey = 'category_id ';
    protected $table = 'tbl_category_product';
}
