<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    use HasFactory;
            protected $fillable=['user_id','region_id','distric_id','city_id','adults','childerns','house','budget','grage','approved','grage','sea_view','renovate','note'];
            public function user(){
                return $this->belongsTo('App\Models\User');
            }
            public function city(){
                return $this->belongsToMany('App\Models\City');
            }
            public function distric(){
                return $this->belongsTo('App\Models\Distric');
            }
            public function region(){
                return $this->belongsTo('App\Models\Region');
            }
    public function getGrageAttribute($value){
        if($value==1){
            return 'Yes';
        }else{
            return 'No';
        }
    }
    public function getSeaViewAttribute($value){
        if($value==1){
            return 'Yes';
        }else{
            return 'No';
        }
    }
    public function getRenovateAttribute($value){
        if($value==1){
            return 'Yes';
        }else{
            return 'No';
        }
    }
}
