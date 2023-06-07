<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_otp extends Model
{
   
     protected $table = 'user_otps';
    public $timestamps = true;
  
    protected $fillable = [
       'user_id','email','otp'
    ];
}
