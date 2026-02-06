<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $fillable = [
		'name',  
		'helps',  
		'mobile_number',  
		'whatsapp_number',  
		'address',  
	];
    /**
     * Set the categories
     *
     */
    public function setHelpsAttribute($value)
    {
        $this->attributes['helps'] = json_encode($value);
    }
  
    /**
     * Get the categories
     *
     */
    public function getHelpsAttribute($value)
    {
        return $this->attributes['helps'] = json_decode($value);
    }
}
