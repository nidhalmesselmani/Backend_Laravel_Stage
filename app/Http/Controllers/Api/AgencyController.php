<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agency;
class AgencyController extends Controller
{
    //



    public function getAgences(Request $request){


        $agencies =  Agency::where('id_insurance',$request->input('id_insurance'))->get();   	

          return response()->json(['data'=>$agencies],200,[],JSON_NUMERIC_CHECK);
    }
}
