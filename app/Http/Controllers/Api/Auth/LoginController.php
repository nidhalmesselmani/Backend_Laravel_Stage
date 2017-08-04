<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    //
    private $client;
       //utiliser le token trait
    use IssueTokenTrait;



    public function __construct(){
      //recuperer le client pour génerer le token
    		$this->client = Client::find(1);
    	}

    public function login(Request $request){


    	    	$this->validate($request,[

    		'username'=>'required',
    		'password'=>'required'
    		
    		]);

          //retourner token
        return $this->issueToken($request,'password');


    }

    public function refresh(Request $request){

    	 	$this->validate($request,[

    		'refresh_token'=>'required'
    		
    		
    		]);

        //retourner token
       return $this->issueToken($request,'refresh_token');



    }

    public function logout(Request $request){
      
      $accessToken = Auth::user()->token();
      

       DB::table('oauth_refresh_tokens')
      ->where('access_token_id',$accessToken->id)
      ->update(['revoked'=>true]);


     $accessToken->revoke();

     return response()->json([],204); 

    
    }
}
