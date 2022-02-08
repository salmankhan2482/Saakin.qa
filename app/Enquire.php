<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquire extends Model
{
    protected $table = 'enquire';

    protected $fillable = ['name','email','phone','message'];
 
	
	 public $timestamps = false;

     public function Agencies()
     {
        return $this->belongsTo('App\Agency','agency_id','id');
     }
    
}
