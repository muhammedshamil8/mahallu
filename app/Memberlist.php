<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memberlist extends Model
{
    protected $fillable = [
        'committe_id',
        'member',
        'designation',
        'description',
    ];
}
