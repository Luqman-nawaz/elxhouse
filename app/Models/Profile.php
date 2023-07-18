<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'address',
        'phone',
        'current_living',
        'region_id',
        'distric_id',
        'adults',
        'childerns',
        'house',
        'budget',
        'grage',
        'sea_view',
        'renovate',
        'company_name',
        'company_number',
        'living_today',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function region(){
        return $this->belongsTo('App\Models\Region');
    }
    public function distric(){
        return $this->belongsTo('App\Models\Distric');
    }
    public function city(){
        return $this->belongsToMany('App\Models\City');
    }
}
