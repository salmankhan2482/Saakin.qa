<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyAreas extends Model
{
    protected $table = 'property_areas';
    protected $guarded = [''];
    
    public function city()
    {
        return $this->belongsTo(PropertyCities::class,'property_cities_id', 'id');
    }
    
    public function subcity()
    {
        return $this->belongsTo(PropertySubCities::class,'property_sub_cities_id','id');
    }

    public function town()
    {
        return $this->belongsTo(PropertyTowns::class, 'property_towns_id', 'id');
    }

    public function props()
    {
        return $this->hasMany(Properties::class);
    }

}
