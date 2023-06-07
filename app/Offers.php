<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Offers;

class Offers extends Model
{
    protected $table = 'offers';
    protected $fillable = [
        'id','supplier_id','image','offer_name','price','unit'
    ];
  

    public function getOfferImageUrlAttribute()
    {   
        
        if($this->image != null)
        {
            $image = '/uploads/'.$this->image;
        }
        else
        {
            $image = '/images/Item_placeholder.png';
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
