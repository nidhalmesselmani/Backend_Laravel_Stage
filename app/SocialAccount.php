<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    //tu peut remplire toute les columns
    protected $guarded = [];

    public function user(){
    	return $this->belongsTo(User::class);
    }

}