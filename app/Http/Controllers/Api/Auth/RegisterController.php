<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
class RegisterController extends Controller
{

	private $client;
    //


   //utiliser le token trait
    use IssueTokenTrait;

    	public function __construct(){
    		$this->client = Client::find(1);
    	}


    public function register(Request $request){

    	

 
    	$this->validate($request,[

    		'name'=>'required',
    		'email'=>'required|email|unique:users,email',
    		'password'=>'required|min:6'
    		]);

    	$user = User::create([
            
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt('password')
           
    		]); 


         return $this->issueToken($request,'password');

    }
}
