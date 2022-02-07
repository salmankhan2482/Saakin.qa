<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyCounter extends Model
{
    protected $table = 'property_counters';
    protected $fillable = [];

    public function property()
    {
        return $this->belongsTo(Properties::class);
    }
}
