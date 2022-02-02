<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyReport extends Model
{
    protected $guarded = [];
    protected $table = 'property_reports';

    public function user()
    {
        return $this->belongsTo('App\User', 'users_id','id');
    }

    public function property()
    {
        return $this->belongsTo('App\Properties', 'properties_id','id');
    }
}
