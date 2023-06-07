<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bookings;
use App\User;
use Auth;
use DB;

class BookingController extends Controller
{
    public function bhistory(Request $request)
    {

       $sdate = $request->input('from_date');
      $ldate = $request->input('to_date');
       
     //die($ldate);
      if($sdate!=null && $ldate!=null){
             
         $datas = Bookings::whereBetween('date', array($sdate, $ldate))->where('status','!=','0')->get(['*']);

      }
      elseif($sdate!=null && $ldate==null)
      {
        $datas = Bookings::where('date', '>=', $sdate)->where('status','!=','0')->get(['*']);
      }
      elseif($sdate==null && $ldate!=null)
      {
        $datas = Bookings::where('date', '<=', $ldate)->where('status','!=','0')->get(['*']);
      }
      else{
        $datas = Bookings::where('status','>','0')->get();

      }
         return view('admin.booking-history',compact('datas'));
      }
    
    public function booking_data(Request $request)
    {

       $sdate = $request->input('from_date');
      $ldate = $request->input('to_date');
       
     //die($ldate);
      if($sdate!=null && $ldate!=null){
             
         $datas = Bookings::whereBetween('date', array($sdate, $ldate))->where('status','!=','0')->get(['*']);

      }
      elseif($sdate!=null && $ldate==null)
      {
        $datas = Bookings::where('date', '>=', $sdate)->where('status','!=','0')->get(['*']);
      }
      elseif($sdate==null && $ldate!=null)
      {
        $datas = Bookings::where('date', '<=', $ldate)->where('status','!=','0')->get(['*']);
      }
      else{
        $datas = Bookings::where('status','>','0')->get();

      }
         return view('admin.sbooking-history',compact('datas'));
      }
    
     public function view($id)
    {  
          $profile = DB::table('bookings')
          ->join('users', 'users.id', '=', 'bookings.supplier_id')
          ->select(['bookings.collector_id','bookings.supplier_id','bookings.date','bookings.time','bookings.offer_ids','users.address_line1','users.address_line2','users.image','users.name','users.email','bookings.id','bookings.status'])
           ->where('bookings.id','=',$id)
           ->where('bookings.status','!=','0')
            ->where('users.status','0')
          ->get(); 
      return view('admin.booking-history-detail',compact('profile'));
    }   


     public function sview($id)
    {  
          $sprofile = DB::table('bookings')
          ->join('users', 'users.id', '=', 'bookings.collector_id')
          ->select(['bookings.collector_id','bookings.supplier_id','bookings.date','bookings.time','bookings.offer_ids','users.address_line1','users.address_line2','users.image','users.name','users.email','bookings.id','bookings.status'])
          ->where('bookings.id','=',$id)
          ->where('bookings.status','!=','0')
           ->where('users.status','0')
          ->get(); 
      return view('admin.sbooking-history-detail',compact('sprofile'));
    }   

     public function deletebooking(Request $request)
    {   
      $id = $request->id;
      $data = Bookings::where('id',$id)->delete();
       return redirect('/bhistory')->with('status','Booking deleted Successfully');
    }

     public function index(Request $request)
    {
        $sdate = $request->input('from_date');
      $ldate = $request->input('to_date');
       
     //die($ldate);
      if($sdate!=null && $ldate!=null){
             
         $datas = Bookings::whereBetween('date', array($sdate, $ldate))->where('status','!=','0')->get(['*']);

      }
      elseif($sdate!=null && $ldate==null)
      {
        $datas = Bookings::where('date', '>=', $sdate)->where('status','!=','0')->get(['*']);
      }
      elseif($sdate==null && $ldate!=null)
      {
        $datas = Bookings::where('date', '<=', $ldate)->where('status','!=','0')->get(['*']);
      }
      else{
        $datas = Bookings::where('status','>','0')->get();

      }
         return view('admin.sbooking-history',compact('datas'));
    }

}
