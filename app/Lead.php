<?php

namespace App;

use App\LeadForwardAgent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Lead extends Eloquent
{
   use SoftDeletes;
   protected $table = 'leads';
   protected $dates = ['deleted_at'];
   protected $guarded = [''];
   protected $appends = ['status_name'];
    
   public function property()
   {
      return $this->belongsTo(Properties::class, 'property_id');
   }

   public function agency()
   {
      return $this->belongsTo('App\Agency', 'agency_id');
   }

   public function forwardAgents()
   {
      return $this->hasMany(LeadForwardAgent::class, 'lead_id');
   }
   public function createdBy()
   {
   return $this->belongsTo(User::class, 'created_by');
   }

}
