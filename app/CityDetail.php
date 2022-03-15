<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityDetail extends Model
{
    protected $table = 'city_details';

    public $timestamps = false;

    public function Cities()
    {
        return $this->belongsTo(City::class,'city_id', 'id');
    }
}
