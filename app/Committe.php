<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Committe extends Model
{
     protected $fillable = [
        'name',
        'description',
    ];
}
