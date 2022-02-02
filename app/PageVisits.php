<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageVisits extends Model
{
    protected $guarded = [];
    protected $table = 'page_visits';

    public function property()
    {
        return $this->belongsTo(Properties::class);
    }
}
