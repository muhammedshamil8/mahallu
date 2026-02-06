<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',  
        'mobile_number',  
        'whatsapp_number', 
        'father_name',  
        'father_mobile_number',  
        'father_whatsapp_number', 
        'mother_name',  
        'mother_mobile_number',  
        'mother_whatsapp_number',  
        'dob',  
        'gender',  
        'class_id',  
        'fee',  
        'address',  
        'description',  
    ];
}
