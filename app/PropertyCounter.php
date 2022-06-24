<?php

namespace App;

use App\Properties;
use Illuminate\Database\Eloquent\Model;

class PropertyCounter extends Model
{
    protected $table = 'property_counters';
    protected $fillable = ['property_id','counter'];

    public function Property()
    {
        return $this->belongsTo('App\Properties','property_id');
    }
}
