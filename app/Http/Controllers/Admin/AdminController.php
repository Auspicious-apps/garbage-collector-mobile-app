<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Bookings;
use App\Offers;
class AdminController extends Controller
{
    public function dashboard()
    {
         $suppliers = User::where('user_type','2')->where('status','0')
        ->count();

         $collector =  User::where('user_type','3')->where('status','0')
        ->count();
          
          $todayuser =  User::whereDate('created_at',Carbon::today())->where('status','0')->count();
           $get_Data = Bookings::where('status','3')->get(['offer_ids']); 
           $sum = 0;
            foreach($get_Data as $data){
           $array = explode(',', $data->offer_ids);
           for($i=0;$i<count($array);$i++){
               
               $offers = Offers::where('id',$array[$i])->sum('price'); 
               $sum = $sum + $offers;

           }
           }

           $last_get_Data = Bookings::where('status','3')->whereMonth(
                'created_at', '=', Carbon::now()->subMonth()->month
            )->get(['offer_ids']); 

             
           $lsum = 0;
            foreach($last_get_Data as $data){
           $array = explode(',', $data->offer_ids);
           for($i=0;$i<count($array);$i++){
               
               $offers = Offers::where('id',$array[$i])->sum('price'); 
               $lsum = $lsum + $offers;

           }
           }
           $current_month_count = Bookings::where('status','3')->count();
           $past_month_count = Bookings::where('status','3')->whereMonth(
                 'created_at', '=', Carbon::now()->subMonth()->month)->count(); 
           $dd = $past_month_count ;
          $difference = (($current_month_count - $dd) / $dd) * 100;
         
          //$datas = Bookings::whereDay('created_at', now()->day)->where('status','>','0')->get();
          $datas = Bookings::where('status','>','0')->orderBy('id','DESC')->take(5)->get();
          //die($datas);
        return view('admin.dashboard',compact('suppliers','collector','todayuser','datas','sum','lsum','difference'));
    }

    
}
