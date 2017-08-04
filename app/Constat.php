<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constat extends Model
{
    //
        protected $table="constat";
        protected $fillable = ['id_user_1', 'id_user_2', 'id_insurance_1','id_insurance_2','begining_date','ending_date','accident_location','accident_date','injuries','minor_injuries','damage_to_vhA','damage_to_vhB','witnesses'];
        public $timestamps = false;
}
