<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\File;
use Auth;

class MyAccountController extends Controller
{
    public function myaccount()
    {
        $id = Auth::user()->id;
        $user = User::where('id',$id)->get(['*']);
            return view('admin.my-account',['user' => $user]);
    }


    public function store(Request $request)
    {
         $id = Auth::user()->id;
   
        $user= User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->address_line1 = $request->input('address_line1');
        $user->address_line2 = $request->input('address_line2');
        $user->city = $request->input('city');
        $user->zip_code = $request->input('zip_code');
        if($request->hasfile('image')){
            // $destination = 'uploads/'.$user->image;
            //  //die($destination);
            // if(File::exists($destination))
            // {
            //     File::delete($destination);
            // } 
            $file = $request->file('image');
           // die($file);
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/',$filename);
            $user->image = $filename;
        }
        $user->update();
        
        return redirect()->back()->with('status','Admin Image Updated Successfully');
    }

}
