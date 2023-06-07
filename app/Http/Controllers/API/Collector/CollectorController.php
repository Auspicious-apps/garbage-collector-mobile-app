<?php

namespace App\Http\Controllers\API\Collector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\User;
use App\User_otp;
use Validator;
use App\Mail\TestMail;
use Hash;
use DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
class CollectorController extends Controller
{
      /* login api */

     public function login(Request $request) { 
        
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email','password']);
          
        if(!Auth::attempt($credentials))
             return response()->json([
                'message' => 'Invalid credentials.'
        ], 401);
         // print_r($user[0]->id);

        $user = $request->user();
        
        $tokenResult = $user->createToken('Personal Access Token');
    
        $token = $tokenResult->token;
      
          if ($request->remember_me)
            $token->expires_at = Carbon::now()->addHours(24);
            $token->save();
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
                'user_id'=>$user->id

            ]);


    }

    /*Register api and verify university email */ 

    public function signup(Request $request) 
    { 
           
            $validator = Validator::make($request->all(), [ 
                'name' => 'required',
                'email' => 'required|string|unique:users',
                'address_line1' => 'required',
                'address_line2' => 'required',
                'password' => 'required|string',
                'password_confirmation' => 'required|same:password',
                'city' => 'required',
                'zip_code' => 'required',
                'phone_number' => 'required|max:10',
                'image' => 'mimes:jpeg,png,jpg,gif',
                // 'university_email' => 'required',
                // 'otp' => 'required'
            ]);
            

            if($validator->fails())
            {

                $errors = $validator->errors();
    
                $messages = [];
    
                foreach ($errors->all() as $message) 
                {
    
                    $messages[]  = $message;
                        
                }
    
                return response()->json(['message'=>$messages], 401);

            }

            else 
            {

            $user = new User([

                'name' => $request->name,

                'email' => $request->email,

                'password' => bcrypt($request->password),

                'plane_password'=>$request->password,

                'user_type' => '3',
                
                'address_line1' => $request->address_line1,
                 
                'address_line2' => $request->address_line2,
                  
                'city' => $request->city,
                   
                'zip_code' => $request->zip_code,
                    
                'phone_number' => $request->phone_number,

                'status'=>'0'
                
                ]);

            

            if($request->image)
            {
                $file = $request->file('image');

                $extention = $file->getClientOriginalExtension();

                $filename = time().'.'.$extention;

                $file->move('uploads/', $filename);

                $user->image = $filename;
                
            }

            $user->save();
            
            return response()->json(['message' => 'Successfully created user!'], 200); 
        }
            
    }
    
     /* Forgot password send otp api*/

    public function sendverificationcode(Request $request) 
    {   
        $email = $request->email;

        $data = $request->all();

        $validator = Validator::make($request->all(), [          
         // 'email' => 'required|ends_with:.edu.eg',
             'email' => 'required|ends_with:.com',
        ]);

        if($validator->fails())
        {
            return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Invalid Email.']);

        } 

        else 
        {
            $optdata = User_otp::where('email',$email)->get(); 
            $user_id = User::where('email',$request->email)->get(['id']);
              if(sizeof($user_id)){
            $otp = rand(1000,9999);
       
                if(sizeof($optdata))
                {
                    $user = User_otp::where('email','=',$request->email)->update(['otp' => $otp]);
                    
                     $details = [
                            'body'=>'your verification code',
                            'otp'=>$otp,
                            
                        ];
                     
                        \Mail::to($email)->send(new TestMail($details));
                    return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Otp sent on your mail!','otp'=>$otp,'email'=>$email]); 
                }

                else
                {

                    $user = User_otp::create([
                    'user_id'=>$user_id[0]->id,
                    'email' => $email,
                    'otp' => $otp 
                    ]);

                    // $user = User::where('id',$user_id)->where('user_type','2')->update(['verified'=>'1']);

                    // $user_meta = User_meta::where('user_id',$user_id)->update(['university_email'=>$email]);
                    //dd($user_meta);

                     $details = [
                            'body'=>'your verification code',
                            'otp'=>$otp,
                            
                        ];
              
                        \Mail::to($email)->send(new TestMail($details));
       

                    return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Otp sent on your mail!','otp'=>$otp,'email'=>$email]);
                } 
                
              }else{
                   return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Email not exist.']);
              }
        }
         
    }

   
    /* Forgot password verify otp api*/
   
    public function verifyotp(Request $request) 
    {   
       $data = $request->all();

       $otp = $request->otp;
      
       $user_id = User::where('email',$request->email)->get(['id']);

        if(sizeof($user_id))
        {
            $optdata = User_otp::where('user_id',$user_id[0]->id)->where('otp',$otp)->get();
          // die($optdata );
            if(sizeof($optdata))
            {
               
               return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Successfully verify otp','email'=>$request->email]);
            }
            else
            {
               return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Invalid otp']);
            }

        }

        else
        {
            return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Email not exist.']);
        }    
           
    }
      /* Forgot password api*/

    public function change_password(Request $request) 
    {  
       
        $new_password = $request->new_password;

        $confirm_password = $request->confirm_password;

        $email = $request->email;

        $user_id = User::where('email',$request->email)->get(['id']);

        if(sizeof($user_id))
        {
            if($new_password == $confirm_password)
            {
        
                    //$user = Auth::user();
                    $password = Hash::make($request->new_password);
                   
                    $user = User::where('email',$email)->update(['password'=>$password,'plane_password'=>$new_password]);
                    
                     return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Password successfully changed!']);
            }
            else
            {
            
                  return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Password not match']);
            }

        }
        else
        {

            return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Email not exist.']);
        }    
    
    }
     /*logout to customer*/  

    public function logout(Request $request) 
    {
        // $user_id = Auth::user()->id;

        // $dtoken = $request->token;

        // $device_token_data= Device_token::where('user_id',$user_id)->where('token',$dtoken)->delete();

        $request->user()->token()->revoke();

        return response()->json([
                'message' => 'Successfully logged out'
            ]);
    }

   /* show details of users*/

    public function user(Request $request) {

        $id = Auth::user()->id;

        $user = User::where('id',$id)->get(['*']);
       // return response()->json($user);

        if($user)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Supplier Data Fetched';
            $data['data']      =         $user;  
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'No Data Found';
            $data['data']           =   [];  
        }
        return $data;
    }
     

      /* change password send otp api*/
       
    public function verificationcode(Request $request) 
    {   
        $email = $request->email;

        $user_id =Auth::user()->id;

        $data = $request->all();

        $optdata = User_otp::where('email',$email)->where('user_id',$user_id)->get(); 
    
        $otp = rand(100000,999999);
       
                if(sizeof($optdata))
                {
                    $user = User_otp::where('email','=',$request->email)->where('user_id',$user_id)->update(['otp' => $otp]);
                    
                     $details = [
                            'body'=>'your verification code',
                            'otp'=>$otp,
                            
                        ];
                     
                        \Mail::to($email)->send(new TestMail($details));
                     return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Otp sent on your mail!','otp'=>$otp]); 
                }
                else{

                    $user = User_otp::create([
                    'user_id'=>$user_id,
                    'email' => $email,
                    'otp' => $otp 
                    ]);
                    
                     $details = [
                            'body'=>'your verification code',
                            'otp'=>$otp,
                            
                        ];
              
                        \Mail::to($email)->send(new TestMail($details));
       

                    return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Otp sent on your mail!','otp'=>$otp]);
                } 
    
         
    }

    /* Change password verifiy otp api*/

    public function verify_otp(Request $request) 
    {   
        $data = $request->all();

        $otp = $request->otp;

        $id =Auth::user()->id;
         
        $optdata = User_otp::where('user_id',$id)->where('otp',$otp)->get();
          // die($optdata );
        if(sizeof($optdata))
        {
               
            return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Successfully verify otp']);
        }
        else
        {
            return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Invalid otp']);
        }
    
           
    }
       /* change password after login */

    public function changepassword(Request $request) 
    {  
        
       $rules=array(
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        );
        
        $messages=array(
            'old_password.required' => 'Please enter old password.',
            'new_password.required' => 'Please enter new Password .',
            'confirm_password.required' => 'Please enter a conform password.'
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

            if($user_type=='3')
              {
        $old_password = $request->old_password;
        
        $new_password = $request->new_password;

        $confirm_password = $request->confirm_password;
        
        if (!(Hash::check($old_password , auth()->user()->password))) 
        {

            return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Old Password not match with your current password!']); 
        }

        if ((Hash::check($new_password , auth()->user()->password))) 
        {

            return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'New Password cannot be same as your current password!']); 
        }
        
        if($new_password == $confirm_password)
        {
        
            $user = Auth::user();
            $user->plane_password = $request->new_password;
            $user->password = Hash::make($request->new_password);
            $user->save();
            
             return response()->json(['status_code'=>1,'status_text'=> 'Success','message'=>'Password successfully changed!']);
        }else{
            
            return response()->json(['status_code'=>0,'status_text'=> 'Failed','message'=>'Password not match']);
        }
        }else{
                
                 return response()->json([
                'message' => 'Unauthorized.'
        ], 401);
                 
              } 
       }
    }
    
     
     /* Delete user api*/

    public function delete_user(Request $request)
    {   
        $id = Auth::user()->id;

        $user = User::Where('id',$id)->delete();

        return response()->json([
                    'message' => 'You have been successfully deleted your account!'
                ], 200); 
        
    }

    /* Edit profile api*/

    public function edituser(Request $request) {

         $id = Auth::user()->id;

        $user = User::where('id',$id)->get(['*']);
        
        // print_r($user[0]->name);
        // die;

        $name = $request->name;

        $address_line1 = $request->address_line1;

        $address_line2 = $request->address_line2;

        // $city = $request->city;

        // $zip_code = $request->zip_code;
        
        $phone_number = $request->phone_number;

        $image = $request->image;
       
  
        // $meta = User_meta::where('user_id',$id)->update([ 
        //                'city'=>$city,
        //                 'country'=>$country,
        //                    ]);
        // $user_data = User::where('id',$id)->update([ 'first_name' => $first_name,
        //         'last_name' => $last_name,'address'=>$address]);
             
        $user_type = Auth::user()->user_type;

            if($user_type=='3')
              {
        if($request->image)
        {
            $file = $request->file('image');

            $extention = $file->getClientOriginalExtension();

            $filename = time().'.'.$extention;

            $file->move('uploads/', $filename);

            $user_meta= User::where('id',$id)->update([ 'image'=>$filename]);
        }
        
         if($request->name)
        {
            $user_meta= User::where('id',$id)->update(['name'=>$name]);
        }

        else
        {
            $user_meta= User::where('id',$id)->update(['name'=>$user[0]->name]);
        }

        // if($request->city)
        // {
        //     $user_meta= User::where('id',$id)->update(['city'=>$city]);
        // }

        // else
        // {
        //     $user_meta= User::where('id',$id)->update(['city'=>$user[0]->city]);
        // }

        // if($request->zip_code)
        // {
        //     $user_meta= User::where('id',$id)->update(['zip_code'=>$zip_code]);
        // }

        // else
        // {
        //     $user_meta= User::where('id',$id)->update(['zip_code'=>$user[0]->zip_code]);
        // }

        if($request->address_line1)
        {
            $user_meta= User::where('id',$id)->update([ 'address_line1' => $address_line1]);
        }

        else
        {
            $user_meta= User::where('id',$id)->update([ 'address_line1' => $user[0]->address_line1]);
        }
          
        if($request->address_line2)
        {
            $user_meta= User::where('id',$id)->update(['address_line2' => $address_line2]);
        }

        else
        {
            $user_meta= User::where('id',$id)->update(['address_line2' => $user[0]->address_line2]);
        }
          
        if($request->phone_number)
        {
            $user_meta= User::where('id',$id)->update(['phone_number'=>$phone_number]);
        }

        else
        {
            $user_meta= User::where('id',$id)->update(['phone_number'=>$user[0]->phone_number]);
        }

        if($user)
        {
            $data['status_code']    =   1;
            $data['status_text']    =   'Success';             
            $data['message']        =   'Profile Updated Successfully';
            $data['data']      =         $user;  
        }
        else
        {
            $data['status_code']    =   0;
            $data['status_text']    =   'Failed';             
            $data['message']        =   'Profile Not Updated !';
            $data['data']           =    [];  
        }
        return $data;

         }else{
                
                 return response()->json([
                'message' => 'Unauthorized.'
        ], 401);
                 
              } 
    }
   
//   public function notifications(Request $request)
//   {
//       $user_id = Auth::user()->id;

//       $device_token = Device_token::where('user_id',$user_id)->get(['user_id']);
        
//       $notifications = []; 

//       for($i=0;$i<count($device_token);$i++){

//       $notification = Notification::where('user_id',$device_token[$i]->user_id)->where('read_status','0')->orderBy('id','DESC')->get(['id','subject','message','image']);

//           $notifications[] = $notification;

//         }

//         if($notifications)
//         {
//             $data['status_code']    =   1;
//             $data['status_text']    =   'Success';             
//             $data['message']        =   'Notifications Fetched Successfully';
//             $data['data']      =         $notifications[0];  
//         }
//         else
//         {
//             $data['status_code']    =   0;
//             $data['status_text']    =   'Failed';             
//             $data['message']        =   'No Not Updated !';
//             $data['data']           =    [];  
//         }
//         return $data;
                
//   }

//   public function delnotifications(Request $request)
//   {
//       $id = Auth::user()->id;

//         $notification_id = $request->notification_id;

//         $user = Notification::Where('user_id',$id)->where('id',$notification_id)->update(['read_status'=>1]);
        
//         if($notification_id)
//         {
//             $data['status_code']    =   1;
//             $data['status_text']    =   'Success';             
//             $data['message']        =   'Notification removed successfully!'; 
//         }
//         else
//         {
//             $data['status_code']    =   0;
//             $data['status_text']    =   'Failed';             
//             $data['message']        =   'No Detail Found'; 
//         }
//          return $data; 
                
//   }

//   public function firebase_refresh_token(Request $request)
//   {
//         $id = Auth::user()->id;  

//         $token = $request->token;

//         $device_tokens= Device_token::where('user_id',$id)->update(['token'=>$token]);
        
//         if($device_tokens)
//         {
//             $data['status_code']    =   1;
//             $data['status_text']    =   'Success';             
//             $data['message']        =   'Token refresh successfully!'; 
//         }
//         else
//         {
//             $data['status_code']    =   0;
//             $data['status_text']    =   'Failed';             
//             $data['message']        =   'No Detail Found'; 
//         }
//          return $data; 
                
//   }
}
