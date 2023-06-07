<?php

namespace App\Http\Controllers\API\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Offers;
use App\Bookings;
use Auth;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
class BookingController extends Controller
{
    public function inprocess_request()
    {
       $id = Auth::user()->id; 

        $user_type = Auth::user()->user_type;
        if($user_type=='2')
        {
       $supplier = Bookings::where('supplier_id',$id)->where('status','1')
          ->get(['id','supplier_id','collector_id','date']); 
        
        if(sizeof($supplier))
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Fetch in process bookings list!';
            $data['data']           = $supplier;
          
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
        }
        return $data;
        //return response()->json('collector is in process');
        }else{
                
                 return response()->json([
                'message' => 'Unauthorized.'
        ], 401);
                 
              }
    }

    public function cancel_request()
    {
        $id = Auth::user()->id; 
        
         $user_type = Auth::user()->user_type;
        if($user_type=='2')
        {
        $supplier = Bookings::where('supplier_id',$id)->where('status','2')
          ->get(['id','supplier_id','collector_id','date']); 
          
        if(sizeof($supplier))
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Fetch cancel bookings list!';
            $data['data']           = $supplier;
          
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
        }
        return $data;
        //return response()->json('collector request is cancelled');
        }else{
                
                 return response()->json([
                'message' => 'Unauthorized.'
        ], 401);
                 
              }
    }

    public function completed_request()
    {
        $id = Auth::user()->id; 

          $user_type = Auth::user()->user_type;
        if($user_type=='2')
        {
      $supplier = Bookings::where('supplier_id',$id)->where('status','3')
          ->get(['id','supplier_id','collector_id','date']); 
          
        if(sizeof($supplier))
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Fetch compelete bookings list!';
            $data['data']           = $supplier;
          
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
        }
        return $data;

         }else{
                
                 return response()->json([
                'message' => 'Unauthorized.'
        ], 401);
                 
              }
    }

    public function new_request()
    {

        $id = Auth::user()->id; 

           $user_type = Auth::user()->user_type;
        if($user_type=='2')
        {
        $supplier = Bookings::where('supplier_id',$id)->where('status','0')
          ->get(['id','supplier_id','collector_id','date']); 
          
        if(sizeof($supplier))
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Fetch in new bookings list!';
            $data['data']           = $supplier;
          
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
        }
        return $data;

          }else{
                
                 return response()->json([
                'message' => 'Unauthorized.'
        ], 401);
                 
              }
    }

    public function booking_detail($id)
    {
          $user_type = Auth::user()->user_type;
        if($user_type=='2')
        {
        $user_offers= Bookings::where('id',$id)->get(['*']);
          
        $array = explode(',', $user_offers[0]->offer_ids);

        $offer = [];

        for($i=0;$i<count($array);$i++){
               
               $offers = Offers::where('id',$array[$i])->get(['id','offer_name','price','unit','image']);

           $offer[]=$offers;
       }
       $result = Arr::flatten($offer);

        $result_array = [];
        $result_array['user'] = $user_offers;
        $result_array['offers'] = $result;

        if(sizeof($result_array))
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Fetch booking details !';
            $data['data']           = $result_array;
          
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
        }
        return $data;

          }else{
                
                 return response()->json([
                'message' => 'Unauthorized.'
        ], 401);
                 
              }
    }

    public function accept_booking($id)
    {
       $user_id = Auth::user()->id;

         $user_type = Auth::user()->user_type;
        if($user_type=='2')
        { 
        $supplier = Bookings::where('supplier_id',$user_id)->where('id',$id)
          ->update(['status'=>'1']); 

        if($supplier)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Accept Booking Request !';
            // $data['data']           = $result_array;
          
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
        }
        return $data;

         }else{
                
                 return response()->json([
                'message' => 'Unauthorized.'
        ], 401);
                 
              }
    }

    public function cancel_booking($id)
    {
       $user_id = Auth::user()->id;

        $user_type = Auth::user()->user_type;
        if($user_type=='2')
        {  
        $supplier = Bookings::where('supplier_id',$user_id)->where('id',$id)
          ->update(['status'=>'2']); 

        if($supplier)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Cancel Booking Request !';
            // $data['data']           = $result_array;
          
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
        }
        return $data;

         }else{
                
                 return response()->json([
                'message' => 'Unauthorized.'
        ], 401);
                 
              }
    }
}
