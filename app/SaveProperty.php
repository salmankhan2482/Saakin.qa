<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaveProperty extends Model
{
    public function Properties(){
        return $this->belongsTo('App\Properties','property_id','id');
    }
}
