<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyAmenity extends Model
{
    protected $table = 'property_amenities';
    protected $primaryKey = 'id';
    public static function getAmmienties($id){
        $ammenties =    PropertyAmenity::find($id);
        if($ammenties){
            return $ammenties->name;
        }

    }
}
