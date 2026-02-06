<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
		'name',  
		'mobile_number',  
		'whatsapp_number',  
		'address',  
	];
}
