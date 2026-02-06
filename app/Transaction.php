<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'receipt_number',
        'date',
        'transaction_type',
        'amount',
        'received_from',
        'member_id',
        'donor_id',
        'student_id',
        'received_from_other',
        'paid_to',
        'staff_id',
        'shop_id',
        'paid_to_other',
        'towards_id',
        'committee_id',
        'payment_mode',
        'receiver_id',
        'payer_id',
        'bank_id',
        'transaction_number',
        'check_details',
        'check_bank_name',
        'description',
    ];
    public function committee()
    {
        return $this->belongsTo(Committe::class, 'committee_id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function donor()
    {
        return $this->belongsTo(Donor::class, 'donor_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
    public function account()
    {
        return $this->belongsTo(Account::class, 'towards_id');
    }
}
