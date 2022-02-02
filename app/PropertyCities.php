<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyCities extends Model
{
    protected $table = 'property_cities';
    protected $guarded = [''];

    public function subcities()
    {
        return $this->hasMany(PropertySubCities::class);
    }

    public function towns()
    {
        return $this->hasMany(PropertyTowns::class);
    }

    public function areas()
    {
        return $this->hasMany(PropertyAreas::class);
    }

    public function properties()
    {
        return $this->hasMany(Properties::class,'id', 'city');
    }
}
