<?php 


namespace App\Http\Controllers\Api\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//pour eviter la répition
trait IssueTokenTrait {
	public function issueToken(Request $request, $grantType,$scope = "*"){

    	$params = [
          'grant_type' => $grantType,
          'client_id' =>   $this->client->id,
          'client_secret'=> $this->client->secret,
          'username' => $request->username ?: $request->email,
          'scope' => $scope

    	];
        if($grantType !== 'social'){
            $params['username'] = $request->username ?: $request->email;
        }

    	$request->request->add($params);

    	$proxy = Request::create('oauth/token','POST');

        //generer an oauth token
    	return Route::dispatch($proxy);   	

	}
}