<?php

namespace App;

use App\Properties;
use App\CompanyRegistration;
use Illuminate\Database\Eloquent\Model;

class Enquire extends Model
{
   protected $table = 'lead';

   protected $fillable = ['name', 'email', 'phone', 'message'];


   public $timestamps = false;


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
}
