<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
		'name',  
		'mobile_number',  
		'whatsapp_number',  
		'address',  
	];
}
