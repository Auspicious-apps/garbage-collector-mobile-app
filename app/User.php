<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Auth;
use DB;
class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type','plane_password','phone_number','address_line1','address_line2','city','zip_code','image','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUserAddressAttribute()
    {   
       $user_address= DB::table('users')->where('user_type','2')->get(['address_line1','city','zip_code']);

        $full_address = $user_address[0]->address_line1.', '.$user_address[0]->city.', '.$user_address[0]->zip_code;
        return $full_address;
    }
     public function getUserImageUrlAttribute()
    {   
        if($this->image != null)
        {
            $image = '/uploads/'.$this->image;
        }
        else
        {
            $image = '/images/Profile_pic_imageholder.png';
        }
        return  $image ;
    }
   
        public function toArray()
    {
        $array = parent::toArray();
        foreach ($this->getMutatedAttributes() as $key)
        {
            if ( ! array_key_exists($key, $array)) {
                $array[$key] = $this->{$key};   
            }
        }
        return $array;
    }
}
