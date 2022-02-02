<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyFloorPlan extends Model
{
    protected $table = 'property_floor_plans';

    protected $fillable = ['property_id','floor_name','floor_size','floor_rooms','floor_bathrooms','floor_images'];

    public $timestamps = false;
}
