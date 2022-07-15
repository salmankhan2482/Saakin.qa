<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class XmlRecord extends Model
{
   protected $table ="xmlrecord";

   protected $fillable = [

      'reference_number', 'offering_type', 'property_type', 'price_on_application','price','rental_period'
      
      ];
}
