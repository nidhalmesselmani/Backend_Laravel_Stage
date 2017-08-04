<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Police;

class PoliceController extends Controller
{
    //


    public function createPolice(Request $request){
                 
    	    	$this->validate($request,[

    		'num_police'=>'required|unique:police,num_police',
    		'id_user'=>'required',
    		'id_insurance'=>'required',
    		'id_agency'=>'required'
    		]);



    	     $police = Police::create([
            'num_police' => request('num_police'),
            'id_user' => request('id_user'),
            'id_insurance' => request('id_insurance'),
            'id_agency' => request('id_agency')

        ]);



    }

    public function insertVehicleData(Request $request){
	    	$this->validate($request,[
	        'num_police'=>'required',
    		'vehicle_brand'=>'required',
    		'vehicle_type'=>'required',
    		'serial_number_vh'=>'required'
    		]);


    			$police = Police::where('num_police',$request->input('num_police'))->first();


    			$police->vehicle_brand = request('vehicle_brand');
    			$police->vehicle_type = request('vehicle_type');
    			$police->serial_number_vh = request('serial_number_vh');


    				if($police->save()){
    						return response('vehicle inserted');
    				}

    				return response('an erreur occured');





    }


      public function getPoliceInfo(Request $request){

       

            $police = Police::where('num_police',$request->input('qrCode'))->first();
            if($police){
                  return response( $police);
              }   else {
                return response("not found");
              }
          


      }
}
