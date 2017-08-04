<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;




use App\User;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Response;
use Illuminate\Support\Facades\Input ;

use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    //

    public function index(){


//    $posts= Auth::user()->posts()->get();

    	   $user= Auth::user();

 //return response()->json(['data'=>$posts],200,[],JSON_NUMERIC_CHECK);
    return response()->json($user,200);
     }


     public function getFirstLogin(){
     	  $user= Auth::user();

     	  return response()->json($user->first_login,200);
     }




    public function modifyUser(Request $request){




    



		//gather information for the post request 
		$userdata = array(
			'license_number' => $request->input('license_number')
		) ;

 	$rules = array(
		'license_number'=>'required',
		);
	    


		    //Run our validation check
		$validator = Validator::make($userdata,$rules);
 
        

        //if validation fails
		if($validator->fails()){
			return response($validator->errors()->all());
		}else{
	       $user= Auth::user();
		   $user->first_name = $request->first_name;
    	   $user->last_name = $request->last_name;
    	   $user->address = $request->address;
    	   $user->postal_code = $request->postal_code;
    	   $user->province = $request->province;
    	   $user->license_number = $request->license_number;
           $user->city = $request->city;

    	   $user->save();

    	      return Response::json(
              $user
        , 200);

		}


  


    //	   	$userdata = array(

	}

	//	) ;

 //return response()->json(['data'=>$posts],200,[],JSON_NUMERIC_CHECK);
  //  return response()->json($userdata,200);
     


     public function forgotPassowrd(Request $request){

     			//gather information for the post request 
		$userdata = array(
			'email' => $request->input('email')
		) ;

		//Set Validation Rule
		$rules = array(
		'email'=>'required|email',
		);

	    //Run our validation check
		$validator = Validator::make($userdata,$rules);
 
        

        //if validation fails
		if($validator->fails()){
			return response($validator->errors()->all());
		}
			else {
			//Grab the user record by the email address provided
			$user = User::where('email','=',$request->input('email'));
	         //if the user record exist then grab the first returned resutlt
					if($user->count())
			{

                 		$user = $user->first();    
                 		//Generate a reset code and the temp password
                        $resetcode = str_random(60);
			        	$passwd = str_random(15);   
			        	//Set the new values in the user
				        $user->password_temp = Hash::make($passwd);
				        $user->reset_code = $resetcode;   
				        // save reset code and temp password to the user db
				if ($user->save()){
                    //set data array, this is the information that will be passed from the angular forgot password form
					$data = array(
					'email'=>$user->email,
						'nom'=>$user->nom,
						'lien'=>URL::to('api/reset',$resetcode),
						'password'=>$passwd,
					);

	               //Send an e-mail to the user
					Mail::send('auth.reminder',$data,function($message) use($user,$data){

                       $message->to($user->email, $user->nom)->subject('GGA Password Recovery Request');


					});
					//inform the user to check their email
					return response('pls check your email');

                    }

              }
              	// If the email address doen not match an email email address in the database
			    return response('email not found');

		
                
		}
     }




public function reset($resetcode){

//Grab the user record where the reset code sent in the email matches the database
	$user = User::where('reset_code','=',$resetcode)
	        ->where('password_temp','!=','');

	        //if the DB search comes back with the records from the query
	if($user->count()){
      //Set The user variable to the first returned record
		$user = $user->first();

	  //Set the user password to the value stored in password_temp, and clear password temp and reset code
      $user->password = $user->password_temp;
       //renitiate the password temp and reset code
    	$user->password_temp = '';
		$user->reset_code = '';
		//Save the record to the database
			if($user->save())
		{
			//let the user that he can use the new password
			return response('your account has been reset, you can use the new password');
		}
		//End User Count
//if no user record was found, then inform the user that the reset code was not found in the database
	return response('could not recover account, Please contact nidhal47@gmail.com for further assistance');
	}

}


public function modifyUserLogin(Request $request){

	     $user= Auth::user();
	     $user->first_login = $request->input('first_login');

	     $user->save();
	     return response('First login has been updated');


	}

}
