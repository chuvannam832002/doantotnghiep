<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'admin_name','admin_email', 'admin_password','admin_phone'
    ];
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';
    public function role(){
        return $this->belongsToMany('App\Models\Role');
    }
//    public function hasAnyRole($role)
//    {
//        if(is_array($role)){
//            foreach ($role as $item) {
//                if($this->hasRole($item))
//                {
//                    return true;
//                }
//            }
//        }else{
//            if($this->hasRole($role))
//            {
//                return true;
//            }
//        }
//        return false;
//
//    }
//    public function hasRole($role){
//        if($this->role()->where('name',$role)->first()){
//            return true;
//        }
//        return false;
//
//    }
}
