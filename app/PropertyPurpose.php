<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyPurpose extends Model
{
    protected $table = 'property_purposes';
    protected $primaryKey = 'id';

    public function LandingPages()
    {
        return $this->hasOne('App\LandingPage');
    }
}
