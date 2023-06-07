<?php

namespace App\Http\Controllers\API\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Offers;
use App\Bookings;
use Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
class OffersController extends Controller
{
    public function store(Request $request)
    {
         $rules=array(
            'offer_name' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'image' => 'required'
        );
        
        $messages=array(
            'offer_name.required' => 'Please select offer name .',
            'price.required' => 'Please select a price.',
            'unit.required' => 'Please select a unit.',
            'image.required' => 'Please select a image.'
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
        
        $user_type = Auth::user()->user_type;
        if($user_type=='2')
        { 

        $offers = new Offers;
        $offers->supplier_id = Auth::user()->id;
        if($request->hasfile('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/',$filename);
            $offers->image = $filename;
        }
        $offers->offer_name = $request->offer_name;
        $offers->price = $request->price;
        $offers->unit = $request->unit;
        $offers->save();
       
         if($offers)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Successfully created Offers!';
            $data['data']      =         $offers;  
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

    public function view()
    {
        $id = Auth::user()->id;
        $user_type = Auth::user()->user_type;
        if($user_type=='2')
        { 
        $offers = Offers::where('supplier_id',$id)->get(['id','image','offer_name','price','unit']);
        if(sizeof($offers))
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Fetch offers list.';
            $data['data']           =    $offers;  
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
    
    public function get_search_result(Request $request)
    {
         $id = Auth::user()->id;
         $rules=array(
            'query' => 'required',
        );
        
        $messages=array(
            'query.required' => 'Please select offer name .',
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
            $user_type = Auth::user()->user_type;
        if($user_type=='2')
        { 
        $query = $request->input('query');

      	$search_result = new Offers;


      	if(isset($query) && $query != null && $query != '')
      	{

	      	$search_result = Offers::where('offer_name','LIKE', '%'. $query . '%')->where('supplier_id',$id)->get(['id','image','offer_name','price','unit']);
                


	      	if(sizeof($search_result) > 0)
	    	{
	    		$data['status_code']    =   1;
	            $data['status_text']    =   'Success';             
	            $data['message']        =   'Search Results Fetched Successfully';
	            $data['data']      =         $search_result;  
	           
	        }
	    	else
	    	{
	    		$data['status_code']    =   0;
	            $data['status_text']    =   'Failed';             
	            $data['message']        =   'No Data Found';
	            $data['data']           =   [];  
	    	}


	    }
	    else
	    {
     		$data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'Please provide the search query.';
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
   
}
