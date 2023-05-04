<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Events\UpdateHistory;

class UserController extends Controller
{
    //
    public function updateAccount(Request $request){
        $validator = Validator::make($request->all(), [
            'phoneno'    => 'required',
            'name' => 'required',
            'address' => 'required',

        ]);

        if ($validator->fails()) return sendError('Validation Error.', $validator->errors(), 422);
        try {
            $name    = $request->get('name');
            $phoneno = $request->get('phoneno');
            $address = $request->get('address');
          
            $user = Auth::user();
            if( $name != '' ){
                $user->name    = $name;
              }
              if( $phoneno != '' ){
                $user->phoneno    = $phoneno;
              }
              if( $address != '' ){
                $user->address    = $address;
              }
           
            
            $user->save();
            event(new UpdateHistory($user));
            $success['id']  = $user->id;
            $message          = 'Yay! A user has been successfully updated.';
            $success['token'] = $user->createToken('accessToken')->accessToken;
        } catch (Exception $e) {
            $success['token'] = [];
            $message          = 'Oops! Unable to update a user.';
        }

        return sendResponse($success, $message);

    }

    public function reset(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
          'cpassword' => 'required',
          'password' => 'required|min:8',

      ]);
    
    if ($validator->fails()) return sendError('Validation Error.', $validator->errors(), 422);

    try {
       // $cpassword    = $request->get('cpassword');
        $password     = $request->get('password');
        
        $user = Auth::user();
          if( $password != '' )
            {
                $user->password    =  bcrypt($password);
            }
             
            $user->save();
            event(new ResetHistory($user));
            $success['id']  = $user->id;
            $message          = 'Yay! A user password reset successfully.';
            $success['token'] = $user->createToken('accessToken')->accessToken;
         
        
       
    } catch (Exception $e) {
        $success['token'] = [];
        $message          = 'Oops! Unable to reset a password.';
    }

    return sendResponse($success, $message);
        
          // 
        

    }
}
