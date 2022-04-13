<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyRegistration extends Model
{
    protected $guarded = '';

    public function inquiry()
    {
        return $this->hasOne(Enquire::class, 'company_registrations_id');
    }

    public function relatedCity()
    {
        return $this->belongsTo(PropertyCities::class, 'city');
    }
}
