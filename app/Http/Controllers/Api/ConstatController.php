<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Constat;
class ConstatController extends Controller
{
    //
    public function postConstat(Request $request){

    	    	$this->validate($request,[
	        'id_user_1'=>'required',
    		'id_insurance_1'=>'required'
    		]);
    	    	    	     $constat = Constat::create([
            'id_user_1' => request('id_user_1'),
            'id_user_2' => request('id_user_2'),
            'id_insurance_1' => request('id_insurance_1'),
            'id_insurance_2' => request('id_insurance_2')

        ]);


    	  return response($constat)  ;	    	     






    }



        public function modifyConstat(Request $request){

            $this->validate($request,[
            'injuries'=>'required',
            'minor_injuries'=>'required',
            'damage_to_vhA'=>'required',
            'damage_to_vhB'=>'required',
            'witnesses'=>'required',
            'id_constat'=> 'required'
            ]);


                $constat = Constat::where('id',$request->input('id_constat'))->first();


                $constat->injuries = request('injuries');
                $constat->minor_injuries = request('minor_injuries');
                $constat->damage_to_vhA = request('damage_to_vhA');
                $constat->damage_to_vhB = request('damage_to_vhB');
                $constat->witnesses = request('witnesses');
           



                    if($constat->save()){
                            return response('data inserted');
                    }

                    return response('an erreur occured');



                return response($constat);



  

        }
}
