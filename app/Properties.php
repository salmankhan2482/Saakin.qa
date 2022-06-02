<?php

namespace App;

use App\Agency;
use App\Enquire;
use App\PropertyCities;
use ReCaptcha\RequestMethod\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Properties extends Model
{
    protected $table = 'properties';

    protected $fillable = ['user_id','city','refference_code','agent_name','agent_picture','whatsapp','agent_id','agency_id','property_name','property_slug','property_type','property_purpose','price','garage','land_area','build_area','age','address','map_latitude','map_longitude','rooms','bathrooms','bedrooms','area','description','featured_image','video_code','rental_period','property_features','status','views'];

    public static function getPropertyInfo($id)
    {
        return Properties::find($id);
    }

    public function getPrice()
    {
        return number_format($this->attributes['price'],0).' QAR';
    }

    public function getSqm()
    {
        if($this->attributes['land_area'] > 0)
        {
            return $this->attributes['land_area'].' sqm';
        }
        else
        {
            return '0 sqm';
        }
    }

    public function getSqft()
    {
        if($this->attributes['land_area'] > 0)
        {            
            return number_format($this->attributes['land_area'],0).' sqft';
        }
        else
        {
            return '0 sqft';
        }
    }    

	public function scopeSearchByKeyword($query, $keyword, $purpose,$type)
    {

            if($keyword!='' and $purpose!='' and $type!='')
            {
                $query->where(function ($query) use ($keyword,$purpose,$type) {
                $query->where("status", "1")
                    ->where("property_purpose", "$purpose")
                    ->where("property_type", "$type")
                    ->orWhere("address", 'like', '%' .$keyword. '%')
                    ->orWhere("property_name", 'like', '%' .$keyword. '%');
                });
            } elseif ($purpose!='' and $type!='') {
                        $query->where(function ($query) use ($keyword,$purpose,$type) {
                        $query->where("status", "1")
                            ->where("property_purpose", "$purpose")
                            ->where("property_type", "$type");
                        });
            } elseif ($purpose!='') {
                        $query->where(function ($query) use ($keyword,$purpose,$type) {
                        $query->where("status", "1")->where("property_purpose", "$purpose");
                        });
            } elseif ($type!=''){
                        $query->where(function ($query) use ($keyword,$purpose,$type) {
                        $query->where("status", "1")->where("property_type", "$type");
                        });
            } else {
                $query->where(function ($query) use ($keyword,$purpose,$type) {
                $query->where("status", "1")
                    ->where("address", 'like', '%' .$keyword. '%')
                    ->orWhere("property_name", 'like', '%' .$keyword. '%');
                });
            }

        return $query;
    }
    public function propertiesTypes()
    {
        return $this->belongsTo('App\Types', 'property_type', 'id');
    }

    public function property_reports(){
        return $this->hasMany('App\PropertyReport');
    }

    public function Agency(){
        return $this->belongsTo('App\Agency','agency_id','id');
    }
    
    public function gallery()
    {
        return $this->hasMany('App\PropertyGallery','property_id','id');
    }
    public function GetInquiries()
    {
        return $this->hasMany('App\Enquire','property_id','id');
    }
    
    public static function getWhatsapp($propertyid)
    {
        $property = Properties::where("id",$propertyid)->first();
        if(!empty($property->whatsapp))
        {
            return $property->whatsapp;
        } else {
            if(!empty($property)) {
                $agency = Agency::where("id",$property->agency_id)->first();
                if(!empty($agency))
                { return $agency->whatsapp; } else { return '#'; }
            } else {
                return '#';
            }
        }
    }

    public static function getPhoneNumber($propertyid)
    {
        $property = Properties::where("id",$propertyid)->first();
        if(empty($property)) {
            return '#';
        } else {
            if(!empty($property)){

                $agency = Agency::where("id",$property->agency_id)->first();
                if(!empty($agency)) { return $agency->phone; }
                else { return '#'; }

            } else {
                return '#';
            }
        }
    }   
    public function getProperty_type()
    {
        $prop = array('4','7','13','15','16','17','23','27','34','35');
        if(in_array($this->attributes['property_type'], $prop))
        { 
            return false; 
        } else {
             return true; 
        }
    } 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function propertyCity()
    {
        return $this->belongsTo(PropertyCities::class, 'city', 'id');
    }
    
    public function propertySubCity()
    {
        return $this->belongsTo(PropertySubCities::class, 'subcity', 'id');
    }
    
    public function propertyTown()
    {
        return $this->belongsTo(PropertyTowns::class, 'town', 'id');
    }

    public function propertyArea()
    {
        return $this->belongsTo(PropertyAreas::class, 'area');
    }

    public function propertyviews()
    {
        return $this->hasMany(ClickCounters::class,'property_id');
    }

    public function pagevisits()
    {
        return $this->hasMany(PageVisits::class,'property_id');
    }

    public function propertyCounter()
    {
        return $this->belongsTo(PropertyCounter::class,'property_id');
    }

    public function amenities()
    {
        return $this->belongsToMany(PropertyAmenity::class, 'amenity_property', 'property_id', 'amenity_id');
    }
}
