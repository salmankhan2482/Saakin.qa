<?php

namespace App;

use App\Properties;
use App\CompanyRegistration;
use Illuminate\Database\Eloquent\Model;

class Enquire extends Model
{
   protected $table = 'leads';
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

   public function companyRegistration()
   {
      return $this->belongsTo(CompanyRegistration::class, 'company_registrations_id');
   }

}
