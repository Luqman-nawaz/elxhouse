<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $fillable=[
        'uuid',
        'customer_id',
        'broker_id',
        'admin_id',
    
    ];
    public function broker(){
        return $this->belongsTo('App\Models\User','broker_id','id');
    }
    public function Customer(){
    return $this->belongsTo('App\Models\User','customer_id','id');
    }
    public function chats(){
    return $this->hasMany('App\Models\Chat','conversation_id','id');
    }
}
