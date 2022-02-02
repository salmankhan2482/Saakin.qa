<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertySubCities extends Model
{
    protected $table = 'property_sub_cities';
    protected $guarded = [''];

    public function city()
    {
        return $this->belongsTo(PropertyCities::class, 'property_cities_id', 'id');
    }

    public function towns()
    {
        return $this->hasMany(PropertyTowns::class);
    }

    public function properties()
    {
        return $this->hasMany(Properties::class,'id', 'subcity');
    }
}
