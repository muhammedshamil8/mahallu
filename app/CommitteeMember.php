<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    protected $fillable = [
        'committee_id',
        'member_id',
        'non_member_id',
        'designation_id',
        'member_type'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
    public function executiveMember()
    {
        return $this->belongsTo(ExecutiveMember::class, 'non_member_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
