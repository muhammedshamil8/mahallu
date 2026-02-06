<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'name',
        'account_no',
        'ifsc_code',
        'branch',
        'account_holder_name',
        'account_type',
        'phone_number',
        'current_balance',
        'address',
    ];
}
