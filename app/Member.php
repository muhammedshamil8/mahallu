<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'family_id',
        'name',
        'relation_id',
        'gender',
        'age',
        'dob',
        'father_name',
        'mobile',
        'whatsapp',
        'email',
        'blood_group',
        'id_card_no',
        'aadhar_card_no', 
        'education',
        'islamic_education',
        'job',
        'job_place',
        'income',
        'is_finding_job',
        'is_looking_marriage',
        'is_name_in_voter_list',
        'marital_status_id',
        'physical_status_id',
        'number_of_child',
        'profile_photo',
        'vehicles', 
        'health_info',  
        'gov_help_info',  
        'description',       
    ];

    public function family()
    {
        return $this->belongsTo(Family::class, 'family_id');
    }

    public function relation()
    {
        return $this->belongsTo(Relation::class, 'relation_id');
    }
    /**
     * Set the education
     *
     */
    public function setEducationAttribute($value)
    {
        $this->attributes['education'] = json_encode($value);
    }
  
    /**
     * Get the education
     *
     */
    public function getEducationAttribute($value)
    {
        return $this->attributes['education'] = json_decode($value);
    }

    /**
     * Set the islamic_education
     *
     */
    public function setIslamicEducationAttribute($value)
    {
        $this->attributes['islamic_education'] = json_encode($value);
    }
  
    /**
     * Get the islamic_education
     *
     */
    public function getIslamicEducationAttribute($value)
    {
        return $this->attributes['islamic_education'] = json_decode($value);
    }
    /**
     * Set the job
     *
     */
    public function setJobAttribute($value)
    {
        $this->attributes['job'] = json_encode($value);
    }
  
    /**
     * Get the job
     *
     */
    public function getJobAttribute($value)
    {
        return $this->attributes['job'] = json_decode($value);
    }
    /**
     * Set the vehicles
     *
     */
    public function setVehiclesAttribute($value)
    {
        $this->attributes['vehicles'] = json_encode($value);
    }
  
    /**
     * Get the vehicles
     *
     */
    public function getVehiclesAttribute($value)
    {
        return $this->attributes['vehicles'] = json_decode($value);
    }
}
