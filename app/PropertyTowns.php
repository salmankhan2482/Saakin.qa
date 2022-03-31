<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyTowns extends Model
{
    protected $guarded = [''];
    protected $table = 'property_towns';

    public function city()
    {
        return $this->belongsTo(PropertyCities::class,'property_cities_id', 'id');
    }

    public function subcity()
    {
        return $this->belongsTo(PropertySubCities::class, 'property_sub_cities_id', 'id');
    }

    public function areas()
    {
        return $this->hasMany(PropertyAreas::class,'property_towns_id', 'id');
    }

    public function properties()
    {
        return $this->hasMany(Properties::class);
    }
    
}
