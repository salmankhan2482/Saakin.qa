<?php

namespace App;

use App\LeadForwardAgent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Lead extends Eloquent
{
    use SoftDeletes;
   protected $table = 'lead';

    protected $dates = ['deleted_at'];
    protected $guarded = [''];

    protected $appends = ['status_name'];

    
   public function property()
   {
      return $this->belongsTo(Properties::class, 'property_id');
   }

   public function Agencies()
   {
      return $this->belongsTo('App\Agency', 'agency_id');
   }

   public function EnquireStatus()
   {
      return $this->belongsTo('App\EnquireStatus', 'enquire_id');
   }

   public function companyRegistration()
   {
      return $this->belongsTo(CompanyRegistration::class, 'company_registrations_id');
   }
   public function GetProperty()
   {
      return $this->belongsTo('App\Properties', 'property_id');
   }

    public function creator()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    public function receiver()
    {
        return $this->belongsTo('App\User', 'received_agent', 'id');
    }
    public function forwarder()
    {
        return $this->belongsTo('App\User', 'forward_agent', 'id');
    }
    public function modifier()
    {
        return $this->belongsTo('App\User', 'updated_by', 'id');
    }
    public function forwardAgents()
    {
        return $this->hasMany(LeadForwardAgent::class, 'lead_id');
    }

}
