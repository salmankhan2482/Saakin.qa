<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopularSearches extends Model
{
    protected $table = 'popular_searches';
    protected $guarded = '';
    public function propertyType()
    {
        return $this->belongsTo(Types::class, 'type_id');
    }

    public function city()
    {
        return $this->belongsTo(PropertyCities::class);
    }
    
    public function subcity()
    {
        return $this->belongsTo(PropertySubCities::class);
    }
    
    public function town()
    {
        return $this->belongsTo(PropertyTowns::class);
    }
    
    public function area()
    {
        return $this->belongsTo(PropertyAreas::class);
    }
}
