<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['motor_id','buyer_id','amount','message','status'];

    public function motor()
    {
        return $this->belongsTo(\App\Models\Motor::class, 'motor_id');
    }

    public function buyer()
    {
        return $this->belongsTo(\App\Models\User::class, 'buyer_id');
    }
}