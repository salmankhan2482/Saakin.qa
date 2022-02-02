<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyNeighborhood extends Model
{
    protected $table = 'property_neighborhood';

    protected $fillable = ['property_id','category_name','title','distance'];

    public $timestamps = false;
}
