<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerClicks extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id','broker_id'
    ];
}
