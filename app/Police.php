<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Police extends Model
{
    //
    protected $table="police";
     protected $primaryKey = 'num_police';
    protected $fillable = ['num_police', 'id_user', 'id_insurance','id_agency','validity','vehicle_brand','vehicle_type','serial_number_vh'];
    public $timestamps = false;

}
