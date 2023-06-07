<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class CollectorController extends Controller
{
    public function index()
    {   
      $supplier =    User::where(['user_type' => '3'])->where('status','0')
       ->select('*')        
        ->get();
      return view('admin.collector-profile-list',['users'=>$supplier]);
    }
    
    public function view($id)
    {   
      $supplier = User::where('id',$id)->get(['*']);
      return view('admin.collector-profile',['users'=>$supplier]);
    }
    
     public function deleteuser(Request $request)
    {   
        $id = $request->id;
      $supplier = User::where('id',$id)->update(['status'=>'1']);
       return redirect('/collectorprofilelist')->with('status','Account deleted Successfully');
    }

    
}
