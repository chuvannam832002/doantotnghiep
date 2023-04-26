<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'name','image','link','category'
    ];
    protected $primaryKey = 'icon_id';
    protected $table = 'tbl_icons';
}
