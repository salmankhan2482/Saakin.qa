<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClickCounters extends Model
{
    protected $table = 'click_counters';
    protected $guarded = [''];

    public function property()
    {
        return $this->belongsTo(Properties::class,'property_id', 'id');
    }
    public function agency()
    {
        return $this->belongsTo(Agency::class,'agency_id', 'id');
    }
}
