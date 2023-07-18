<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable=['user_id','uuid','conversation_id','sender_id','receiver_id','messages','is_read'];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
