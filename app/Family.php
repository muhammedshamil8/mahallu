<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //add this line

class Family extends Model
{
    
    use SoftDeletes; //add this line

    protected $fillable = [
        'head_of_family',
        'house_name',
        'house_number',
        'name_of_field',
        'mobile_number',
        'whatsapp_number',
        'pin_number',
        'ward_no',
        'land_mark',
        'post_no',
        'type_of_house',
        'well',
        'water_connection',
        'gas',
        'area_of_land',
        'place',
        'district',
        'relegion',
        'ration_card',
        'ration_card_no',
        'house_ownership',
        'house_owner_name',
        'financial_status',  
        'vehicles',
        'favorite_masjid', 
        'description'   
    ];

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

    /**
     * Set the favorite_masjid
     *
     */
    public function setFavoriteMasjidAttribute($value)
    {
        $this->attributes['favorite_masjid'] = json_encode($value);
    }
  
    /**
     * Get the favorite_masjid
     *
     */
    public function getFavoriteMasjidAttribute($value)
    {
        return $this->attributes['favorite_masjid'] = json_decode($value);
    }
}
