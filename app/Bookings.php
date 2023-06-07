<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bookings;
use DB;
use Illuminate\Support\Arr;
use Auth;
class Bookings extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'supplier_id','collector_id','offer_ids','date','time','status'
    ];

    public function getFormattedAtAttribute()
    {   
       $date= date('F j,Y', strtotime($this->date));
        return $date;
    }

    public function getUserNameAttribute()
    {   
        $user_type = Auth::user()->user_type;

        if($user_type=='2')
        {
            $user_data= DB::table('users')->where('id',$this->collector_id)->get(['name']);
            return $user_data[0]->name;
        }else{
            $user_data= DB::table('users')->where('id',$this->supplier_id)->get(['name']);
            return $user_data[0]->name;
        }
    }

    public function getUserAddressAttribute()
    {   
         $user_type = Auth::user()->user_type;

        if($user_type=='2')
        {
           $user_address= DB::table('users')->where('id',$this->collector_id)->get(['address_line1','city','zip_code']);

            $full_address = $user_address[0]->address_line1.', '.$user_address[0]->city.', '.$user_address[0]->zip_code;
            return $full_address;
        }else{
               $user_address= DB::table('users')->where('id',$this->supplier_id)->get(['address_line1','city','zip_code']);

              $full_address = $user_address[0]->address_line1.', '.$user_address[0]->city.', '.$user_address[0]->zip_code;
              return $full_address;
        }
    }
     
    public function getUserImageAttribute()
    {   
       $user_data= DB::table('users')->where('id',$this->collector_id)->get(['image']);
       
       if($user_data[0]->image != null )
        $image = '/uploads/'.$user_data[0]->image;
       else
        $image = '/images/Profile_pic_imageholder.png';
        
        return $image;
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
