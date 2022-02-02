<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    protected $table = 'landing_pages';

    public function PropertyPurposes()
    {
        return $this->belongsTo('App\PropertyPurpose', 'property_purposes_id', 'id');
    }
    public function PropertyTypes()
    {
        return $this->belongsTo('App\Types', 'property_types_id', 'id');
    }

}
