<?php

namespace App\Http\Controllers\API\Collector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Offers;
use App\Bookings;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        
        $rules=array(
            'supplier_id' => 'required',
            'offer_ids' => 'required',
            'date' => 'required',
            'time' => 'required'
        );
        
        $messages=array(
            'supplier_id.required' => 'Please select the supplier.',
            'offer_ids.required' => 'Please select atleast one offer .',
            'date.required' => 'Please select a valid date.',
            'time.required' => 'Please select a valid time.'
        );
        
        $validator = Validator::make( $request->all(), $rules, $messages );

        if ( $validator->fails() ) 
        {
            return [
                'status_code' => 0,
                'status_text' => 'Failed',
                'message' => $validator->errors()->first()
            ];
        }
        else
        {
            
            $user_id = Auth::user()->id;
            $user_type = Auth::user()->user_type;

            if($user_type=='3')
              {
                 
            $booking=DB::table('bookings')->insert(['supplier_id'=>$request->supplier_id,'collector_id'=>$user_id,'offer_ids'=>$request->offer_ids,'date'=>$request->date,'time'=>$request->time,'status'=>'0','created_at'=>carbon::now(),'updated_at'=>carbon::now()]);
            if($booking)
            {
                $data['status_code']    =   1;
                $data['status_text']    =   'Success';             
                $data['message']        =   'Successfully created booking!';
                //$data['data']      =         $booking;  
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

    public function getsuppliers()
    {
         $user_type = Auth::user()->user_type;

            if($user_type=='3')
              {
        $supplier = User::where(['user_type' => '2'])->get(['id','name','image']);
        if(sizeof($supplier))
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'User fetch successfully';
            $data['data']      =         $supplier;  
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
        }
        return $data ;
       }else{
                
                 return response()->json([
                'message' => 'Unauthorized.'
        ], 401);
                 
              }  
    }

    //get particular supplier offers
    public function supplierid($id)
    {
        $user_type = Auth::user()->user_type;
        if($user_type=='3')
        {

        $profile = Offers::where('supplier_id',$id)
        ->get(['id','offer_name','price','unit','image']);
        if(sizeof($profile))
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'User offers selected';
            $data['data']           =    $profile;  
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

   // reschedule api
    public function updateavals(Request $request,$id)
    {
       $user_id = Auth::user()->id;

        $user_type = Auth::user()->user_type;
        if($user_type=='3')
        {

        $supplier = Bookings::where('collector_id',$user_id)->where('id',$id)
          ->update(['date'=>$request->date,'time'=>$request->time]); 

        if($supplier)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Appointment Re-schedule!';
            // $data['data']           =    $supplier;  
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

    //get particular supplier
    public function getselecteddata($id)
    {
         $user_type = Auth::user()->user_type;
        if($user_type=='3')
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

    public function complete_appointment(Request $request)
    {
        $id = Auth::user()->id; 
        //return $id;
         $user_type = Auth::user()->user_type;
        if($user_type=='3')
        {
        $supplier = Bookings::where('collector_id',$id)->where('status','3')
          ->get(['id','supplier_id','collector_id','date']); 
        if(sizeof($supplier) > 0)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Completed Appointments fetched successfully';
            $data['data']      =         $supplier;  
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data found';
            $data['data']           =   [];  
        }
        return $data;
         }else{
                
                 return response()->json([
                'message' => 'Unauthorized.'
        ], 401);
                 
              }
    }
    
  public function upcoming_appointment(Request $request)
    {
        $id = Auth::user()->id; 
        //return $id;
          $user_type = Auth::user()->user_type;
        if($user_type=='3')
        {
        $supplier = Bookings::where('collector_id',$id)->where('status','1')
          ->get(['id','supplier_id','collector_id','date']); 

        if(sizeof($supplier) > 0)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Upcoming Appointments fetched successfully';
            $data['data']      =         $supplier;  
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data found';
            $data['data']           =   [];  
        }
        return $data;

          }else{
                
                 return response()->json([
                'message' => 'Unauthorized.'
        ], 401);
                 
              }
    }
    
    public function complete_booking($id)
    {
       $user_id = Auth::user()->id;

         $user_type = Auth::user()->user_type;
        if($user_type=='3')
        { 
        $supplier = Bookings::where('collector_id',$user_id)->where('id',$id)
          ->update(['status'=>'3']); 

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
       
}
