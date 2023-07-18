<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distric extends Model
{
    use HasFactory;
    protected $fillable=[
        'city_id','region_id','name'
    ];
    public function city(){
        return $this->belongsTo('App\Models\City');
    }
    public function region(){
        return $this->belongsTo('App\Models\Region');
    }
}
