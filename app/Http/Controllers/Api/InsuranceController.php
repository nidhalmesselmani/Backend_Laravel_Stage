<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Insurance;

class InsuranceController extends Controller
{
    //


    public function index(){


    	$insurances = Insurance::all();

              return response()->json(['data'=>$insurances],200,[],JSON_NUMERIC_CHECK);
    	

    }
}
