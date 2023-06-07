<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function user_details($id)
    {
        
        $user_count = User::where('id',$id)->count();
        
        if($user_count > 0)
        {
            $user_data = User::where('id',$id)->get(['*']);
        }
        else
        {
            $user_data = [];
        }
        
        if($user_data)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'User detailed fetched successfully!';
            $data['data']      =         $user_data;  
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'Invalid User';
            $data['data']           =   [];  
        }
        return $data;
        
    }
}
