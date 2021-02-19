<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\User;
use Validator;
   
class UserController extends BaseController
{
 /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
            'address' => 'required',
            'zipcode'=> 'required|digits:5',
            'user_profile'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'license_doc'=> 'required|image|mimes:png,jpg,gif,svg|max:2048',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error-'.$validator->errors(), $validator->errors());       
        }
        //----------------image
            $profileName = '';
        if($request->hasFile('user_profile')) {
            $profileName = time().'.'.$request->user_profile->extension();  
            $request->user_profile->move(public_path('images/profile'), $profileName);
        }

            $licenseName = '';
        if($request->hasFile('license_doc')) {
            $licenseName = time().'.'.$request->license_doc->extension();  
            $request->license_doc->move(public_path('images/license'), $licenseName);
        }
        $request->merge([
        'profile' => $profileName,    
        'license' => $licenseName,    
        ]);
        //----------------image
   
        $input = $request->all();
        $user = User::create($input);
        // $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['message'] =  'User register successfully.';
   
        return $this->sendResponse($success, 'User register successfully.');
    }

    }