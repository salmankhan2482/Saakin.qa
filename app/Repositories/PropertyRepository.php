<?php

namespace App\Repositories;
use App\User;
use App\Properties;
use App\LandingPage;
use App\PropertyAreas;
use App\PropertyTowns;
use App\AmenityProduct;
use App\PropertyCities;
use App\PopularSearches;
use App\PropertyAmenity;
use App\PropertySubCities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyRepository
{


   public function breadcrumbs(Request $request)
   {
      $result = DB::table('properties')->where('id', -1);
      if (
         request('property_purpose') && 
         request('property_type') && 
         request('city') && 
         request('subcity') && 
         request('town') && 
         request('area')) {
         $result = DB::table('properties')->where('id', -1);

      } elseif (
         request('property_purpose') && 
         request('property_type') && 
         request('city') && 
         request('subcity') && 
         request('town')) {

         $data['subcity'] = PropertySubCities::find(request('subcity'));
         $data['town'] = PropertyTowns::find(request('town'));

         $property_type_purpose =
            Str::slug(request('type')->plural . '-for-' . request('property_purpose') . '-' . $data['subcity']->name . '-' . $data['town']->name);

         $result = DB::table('property_areas')
         ->leftJoin('properties', 'property_areas.id', 'properties.area')
         ->select('property_areas.*', DB::Raw(' COUNT(properties.id) as pcount '))
         ->where('property_areas.property_cities_id', request('city'))
         ->where('town_slug', $property_type_purpose)
            ->where('property_purpose', ucfirst(request('property_purpose')))
            ->where('properties.property_type', request('property_type'))
            ->groupBy("property_areas.id")
            ->orderBy("pcount", "desc")
            ->where("status", 1);

         $result = DB::table('property_towns')
         ->leftJoin('properties', 'property_towns.id', 'properties.town')
         ->select('property_towns.*', DB::Raw(' COUNT(properties.id) as pcount '))
         ->where('property_towns.property_sub_cities_id', request('subcity'))
         ->where('sub_city_slug', $property_type_purpose)
            ->where('property_purpose', ucfirst(request('property_purpose')))
            ->where('properties.property_type', request('property_type'))
            ->groupBy("property_towns.id")
            ->orderBy("pcount", "desc")
            ->where("status", 1);
      } elseif (
         request('property_purpose') &&
         request('property_type') && 
         request('city') && 
         request('subcity')) {

         $data['subcity'] = PropertySubCities::find(request('subcity'));
         $property_type_purpose = Str::slug(request('type')->plural . '-for-' . request('property_purpose') . '-' . $data['subcity']->name);

         $result = DB::table('property_towns')
         ->leftJoin('properties', 'property_towns.id', 'properties.town')
         ->select('property_towns.*', DB::Raw(' COUNT(properties.id) as pcount '))
         ->where('property_towns.property_sub_cities_id', request('subcity'))

         ->where('sub_city_slug', $property_type_purpose)
            ->where('property_purpose', ucfirst(request('property_purpose')))
            ->where('properties.property_type', request('property_type'))
            ->groupBy("property_towns.id")
            ->orderBy("pcount", "desc")
            ->where("status", 1);
      } elseif (
         request('property_purpose') && 
         request('property_type') && 
         request('city')) {

         $result = DB::table('property_sub_cities')
         ->leftJoin('properties', 'property_sub_cities.id', 'properties.subcity')
         ->select('property_sub_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
         ->where('property_sub_cities.property_cities_id', request('city'))

         ->where('property_purpose', ucfirst(request('property_purpose')))
         ->where('properties.property_type', request('property_type'))
         ->groupBy("property_sub_cities.id")
         ->orderBy("pcount", "desc")
         ->where("status", 1);
      } elseif (
         request('property_purpose') && 
         request('property_type')) {

         $result = DB::table('property_cities')
         ->leftJoin('properties', 'property_cities.id', 'properties.city')
         ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
         ->where('property_purpose', ucfirst(request('property_purpose')))

         ->where('property_type', request('property_type'))
         ->groupBy('property_cities.name')
         ->orderBy("pcount", "DESC")
         ->where("status", 1);
      }
      $result = $result->when(request('min_price') != 0 && request('max_price') != 0, function ($query) {
         $query->whereBetween('properties.price', [(int)request()->get('min_price'), (int)request()->get('max_price')]);
      })
         ->when(request('min_price') != 0 && request('max_price') == 0, function ($query) {
            $query->where('properties.price', '>=', [(int)request()->get('min_price')]);
         })
         ->when(request('min_price') == 0 && request('max_price') != 0, function ($query) {
            $query->where('properties.price', '<=', [(int)request()->get('max_price')]);
         })
         ->when(request('min_price') == 0 && request('max_price') == 0, function ($query) {
            //no condition to run
         })
         ->when(request('min_area') != 0 && request('max_area') != 0, function ($query) {
            $query->whereBetween('properties.land_area', [(int)request()->get('min_area'), (int)request()->get('max_area')]);
         })
         ->when(request('min_area') != 0 && request('max_area') == 0, function ($query) {
            $query->where('properties.land_area', '>=', [(int)request()->get('min_area')]);
         })
         ->when(request('min_area') == 0 && request('max_area') != 0, function ($query) {
            $query->where('properties.land_area', '<=', [(int)request()->get('max_area')]);
         })
         ->when(isset($request->bedrooms) && !empty($request->bedrooms), function ($query) {
            if (request('bedrooms') == "6+") {
               $query->where('properties.bedrooms', '>=', 6);
            } else {
               $query->where('properties.bedrooms', request('bedrooms'));
            }
         })
         ->when(isset($request->bathrooms) && !empty($request->bathrooms), function ($query) {
            if (request('bathrooms') == "6+") {
               $query->where('properties.bathrooms', '>=', 6);
            } else {
               $query->where('properties.bathrooms', request('bathrooms'));
            }
         })
         ->when(request('furnishings'), function ($query) {
            $query->where('properties.property_features', 'like', '%' . request()->get('furnishings') . '%');
         })->get();
      return $result;
   }
   
   public function sortyBy($properties, Request $request)
   {
      if (isset(request()->sort_by) && !empty(request()->sort_by)) {
         if (request()->sort_by == "newest") {
            $properties->orderBy('id', 'desc');
         } else if (request()->sort_by == "featured") {
            $properties->orderBy('featured_property', 'desc');
         } else if (request()->sort_by == "low_price") {
            $properties->orderBy('price', 'asc');
         } else if (request()->sort_by == "high_price") {
            $properties->orderBy('price', 'desc');
         } else if (request()->sort_by == "beds_least") {
            $properties->orderBy('bedrooms', 'asc');
         } else if (request()->sort_by == "beds_most") {
            $properties->orderBy('bedrooms', 'desc');
         }
      } else {
         $properties->orderBy('id', 'desc');
      }
      return $properties;
   }
   public function getProperties(Request $request)
   {
      $properties = Properties::where('status', 1)
         ->when(request()->property_purpose, function ($query) {
            $query->where('property_purpose', request()->property_purpose);
         })
         ->when(request()->city, function ($query) {
            $query->where('city', request()->city);
         })
         ->when(request()->subcity, function ($query) {
            $query->where('subcity', request()->subcity);
         })
         ->when(request()->town, function ($query) {
            $query->where('town', request()->town);
         })
         ->when(request()->area, function ($query) {
            $query->where('area', request()->area);
         })
         ->when(request('property_type'), function ($query) {
            $query->where('property_type', request('property_type'));
         })
         ->when(request('min_price') != 0 && request('max_price') != 0, function ($query) {
            $query->whereBetween('price', [(int)request()->get('min_price'), (int)request()->get('max_price')]);
         })
         ->when(request('min_price') != 0 && request('max_price') == 0, function ($query) {
            $query->where('price', '>=', [(int)request()->get('min_price')]);
         })
         ->when(request('min_price') == 0 && request('max_price') != 0, function ($query) {
            $query->where('price', '<=', [(int)request()->get('max_price')]);
         })
         ->when(request()->get('furnishings'), function ($query) {
            $query->where('property_features', 'like', '%' . request()->get('furnishings') . '%');
         })
         ->when(request()->get('amenities'), function ($query) {
            $ids = array();
            foreach (request()->get('amenities') as $value) {
               $records =  AmenityProduct::where('amenity_id', $value)->select('property_id')->get();
               foreach ($records as $value) {
                  array_push($ids, $value->property_id);
               }
            }
            $result = array_unique($ids);
            $query->whereIn('id', $result);
         })
         ->when(request('min_area') != 0 && request('max_area') != 0, function ($query) {
            $query->whereBetween('land_area', [(int)request()->get('min_area'), (int)request()->get('max_area')]);
         })
         ->when(request('min_area') != 0 && request('max_area') == 0, function ($query) {
            $query->where('land_area', '>=', [(int)request()->get('min_area')]);
         })
         ->when(request('min_area') == 0 && request('max_area') != 0, function ($query) {
            $query->where('land_area', '<=', [(int)request()->get('max_area')]);
         })
         ->when(isset($request->bedrooms) && !empty($request->bedrooms), function ($query) {
            if (request('bedrooms') == "6+") {
               $query->where('properties.bedrooms', '>=', 6);
            } else {
               $query->where('properties.bedrooms', request('bedrooms'));
            }
         })
         ->when(isset($request->bathrooms) && !empty($request->bathrooms), function ($query) {
            if (request('bathrooms') == "6+") {
               $query->where('properties.bathrooms', '>=', 6);
            } else {
               $query->where('properties.bathrooms', request('bathrooms'));
            }
         })
         ->when(request()->agent, function ($query) {
            $query->where('agency_id', request()->agent);
         });


      $commercialIds = array();
      array_push($commercialIds, '14', '17', '23', '27', '4', '13', '7', '34', '16', '35');

      if (isset($request->commercial)) {
         $properties->whereIn('property_type', $commercialIds);
      } elseif (!in_array(request('property_type'), $commercialIds)) {
         $properties->whereNotIn('property_type', $commercialIds);
      }

      if (isset($request->sort_by) && !empty($request->sort_by)) {
         if ($request->sort_by == "newest") {
            $properties->orderBy('id', 'desc');
         } else if ($request->sort_by == "featured") {
            $properties->orderBy('featured_property', 'desc');
         } else if ($request->sort_by == "low_price") {
            $properties->orderBy('price', 'asc');
         } else if ($request->sort_by == "high_price") {
            $properties->orderBy('price', 'desc');
         } else if ($request->sort_by == "beds_least") {
            $properties->orderBy('bedrooms', 'asc');
         } else if ($request->sort_by == "beds_most") {
            $properties->orderBy('bedrooms', 'desc');
         }
      } else {
         $properties->orderBy('id', 'desc');
      }

      if (request('featured') == 1) {
         $properties = $properties->where("featured_property", "1")->paginate(getcong('pagination_limit'));
      } else {
         $properties = $properties->paginate(getcong('pagination_limit'));
      }
      return $properties;
   }
    
   public function getPropertyTypes()
   {
      $types = DB::table('property_types')
      ->join('properties', "property_types.id", "properties.property_type")
      ->select(
         'property_types.id',
         'property_types.types',
         'property_types.plural',
         DB::Raw('COUNT(properties.id) as pcount')
      )
      ->when(request()->property_purpose != '', function ($query) {
         $query->where("properties.property_purpose", request()->property_purpose);
      })
      ->where("properties.status", 1)
      ->groupBy("property_types.id")
      ->orderBy("pcount", "desc")->get();

      return $types;
   }

   public function landingPageContent()
   {
      $property_purpose_id = request('property_purpose') == 'Rent' ? 1 : 2;

      //  Property Purpose
      if (!empty(request('property_purpose')) && empty(request('property_type')) && empty(request('city')) && empty(request('subcity')) && empty(request('town')) && empty(request('area'))) {
         $landing_page_content = LandingPage::where('property_purposes_id', $property_purpose_id)
            ->where('property_types_id', null)
            ->where('property_cities_id', null)
            ->where('property_sub_cities_id', null)
            ->where('property_towns_id', null)
            ->where('property_areas_id', null)
            ->first();
         if ($landing_page_content == null) {
            $page_des = getcong('site_description');
         } else {
            $page_des = Str::limit($landing_page_content->page_content, 170, '...');
         }

         // Property Type For Purpose

      } elseif (!empty(request('property_purpose')) && !empty(request('property_type')) && empty(request('city')) && empty(request('subcity')) && empty(request('town')) && empty(request('area'))) {
         $landing_page_content = LandingPage::where('property_purposes_id', $property_purpose_id)
            ->where('property_types_id', request('property_type'))
            ->where('property_cities_id', null)
            ->where('property_sub_cities_id', null)
            ->where('property_towns_id', null)
            ->where('property_areas_id', null)
            ->first();
         if ($landing_page_content == null) {
            $page_des = getcong('site_description');
         } else {
            $page_des = Str::limit($landing_page_content->page_content, 170, '...');
         }

         // City Property Type For Purpose

      } elseif (!empty(request('property_purpose')) && !empty(request('property_type')) && !empty(request('city')) && empty(request('subcity')) && empty(request('town')) && empty(request('area'))) {
         $landing_page_content = LandingPage::where('property_purposes_id', $property_purpose_id)
            ->where('property_types_id', request('property_type'))
            ->where('property_cities_id', request('city'))
            ->where('property_sub_cities_id', null)
            ->where('property_towns_id', null)
            ->where('property_areas_id', null)
            ->first();
         if ($landing_page_content == null) {
            $page_des = getcong('site_description');
         } else {
            $page_des = Str::limit($landing_page_content->page_content, 170, '...');
         }

         // Sub-City Type For Property Purpose

      } elseif (!empty(request('property_purpose')) && !empty(request('property_type')) && !empty(request('city')) && !empty(request('subcity')) && empty(request('town')) && empty(request('area'))) {
         $landing_page_content = LandingPage::where('property_purposes_id', $property_purpose_id)
            ->where('property_types_id', request('property_type'))
            ->where('property_cities_id', request('city'))
            ->where('property_sub_cities_id', request('subcity'))
            ->where('property_towns_id', null)
            ->where('property_areas_id', null)
            ->first();
         if ($landing_page_content == null) {
            $page_des = getcong('site_description');
         } else {
            $page_des = Str::limit($landing_page_content->page_content, 170, '...');
         }

         //Town Property Type For Purpose

      } elseif (!empty(request('property_purpose')) && !empty(request('property_type')) && !empty(request('city')) && !empty(request('subcity')) && !empty(request('town')) && empty(request('area'))) {
         $landing_page_content = LandingPage::where('property_purposes_id', $property_purpose_id)
            ->where('property_types_id', request('property_type'))
            ->where('property_cities_id', request('city'))
            ->where('property_sub_cities_id', request('subcity'))
            ->where('property_towns_id', request('town'))
            ->where('property_areas_id', null)
            ->first();
         if ($landing_page_content == null) {
            $page_des = getcong('site_description');
         } else {
            $page_des = Str::limit($landing_page_content->page_content, 170, '...');
         }

         //Area Property Type For Purpose

      } elseif (!empty(request('property_purpose')) && !empty(request('property_type')) && !empty(request('city')) && !empty(request('subcity')) && !empty(request('town')) && !empty(request('area'))) {
         $landing_page_content = LandingPage::where('property_purposes_id', $property_purpose_id)
            ->where('property_types_id', request('property_type'))
            ->where('property_cities_id', request('city'))
            ->where('property_sub_cities_id', request('subcity'))
            ->where('property_towns_id', request('town'))
            ->where('property_areas_id', request('area'))
            ->first();
         if ($landing_page_content == null) {
            $page_des = getcong('site_description');
         } else {
            $page_des = Str::limit($landing_page_content->page_content, 170, '...');
         }
      } else {
         $landing_page_content = LandingPage::where('property_purposes_id', null)
         ->where('property_types_id', null)
         ->where('property_cities_id', null)
         ->where('property_sub_cities_id', null)
         ->where('property_towns_id', null)
         ->where('property_areas_id', null)
         ->first();
         // dd($landing_page_content);
         if ($landing_page_content == null) {
            $page_des = getcong('site_description');
         } else {
            $page_des = Str::limit($landing_page_content->page_content, 170, '...');
         }
      }

      return $landing_page_content;
   }

   public function headerName(){
      $name = '';
      $furnishing = '';
      if (request('furnishings')) {
         $furnishing = $this->furnishing(request('furnishings'));
         $name = $name . $furnishing;
      }

      if (request('bedrooms')) {
         $name = $name . (request('bedrooms') ? request('bedrooms') . ' bedroom ' : '');
      }
      if (request('bathrooms')) {
         $name = $name . (request('bathrooms') ? request('bathrooms') . ' bathroom ' : '');
      }
      
      if (request('type')) {
         $name = $name . request('type')->plural_name . ' for ' . request('property_purpose');
      } else {
         $name = $name . 'properties for ' . request('property_purpose');
      }

      if (request('city') && request('subcity') && request('town') && request('area')) {
         $area = PropertyAreas::where('id', request('area'))->value('name');
         $name = $name . ' in ' . $area;
      } elseif (request('city') && request('subcity') && request('town')) {
         $town = PropertyTowns::where('id', request('town'))->value('name');
         $name = $name . ' in ' . $town;
      } elseif (request('city') && request('subcity')) {
         $subcity = PropertySubCities::where('id', request('subcity'))->value('name');
         $name = $name . ' in ' . $subcity;
      } elseif (request('city')) {
         $city = PropertyCities::where('id', request('city'))->value('name');
         $name = $name . ' in ' . $city;
      } else {
         $name = $name . ' in Qatar';
      }
      return $name;
   }

   public function furnishing($furnishings)
   {
      return PropertyAmenity::where('id', $furnishings)->value('name') . ' ';
   }

   public function popularSearches($name = '', $link = '')
   {
      if (request('property_purpose') != '') {
         $popularSearch = PopularSearches::updateOrCreate(
            [
               'property_purpose' => request('property_purpose'),
               'type_id' => request('property_type'),
               'name' => $name,
               'city_id' => request('city'),
               'subcity_id' => request('subcity'),
               'town_id' => request('town'),
               'area_id' => request('area'),
               'furnishings' => request('furnishings'),
               'bedrooms' => request('bedrooms'),
            ],
            [
               'count' => DB::raw('count + 1'),
               'link' => $link,
            ]
         );
         return $popularSearch;
      }
   }

   public function getNearbyProperties(Request $request)
   {
      $properties = Properties::where('status', 1)
      ->when(request()->property_purpose, function ($query) {
         $query->where('property_purpose', request()->property_purpose);
      })
      ->when(request()->area, function ($query) {
         $query->where('town', request()->town);
      })
      ->when(request()->town, function ($query) {
         $query->where('subcity', request()->subcity);
      })
      ->when(request()->subcity, function ($query) {
         $query->where('city', request()->city);
      })
      ->when(request()->city, function ($query) {
         // $query->where('city', request()->city);
      })
      ->when(request('property_type'), function ($query) {
         $query->where('property_type', request('property_type'));
      })
      ->when(request('min_price') != 0 && request('max_price') != 0, function ($query) {
         $query->whereBetween('price', [(int)request()->get('min_price'), (int)request()->get('max_price')]);
      })
      ->when(request('min_price') != 0 && request('max_price') == 0, function ($query) {
         $query->where('price', '>=', [(int)request()->get('min_price')]);
      })
      ->when(request('min_price') == 0 && request('max_price') != 0, function ($query) {
         $query->where('price', '<=', [(int)request()->get('max_price')]);
      })
      ->when(request()->get('furnishings'), function ($query) {
         $query->where('property_features', 'like', '%' . request()->get('furnishings') . '%');
      })
      ->when(request()->get('amenities'), function ($query) {
         $ids = array();
         foreach (request()->get('amenities') as $value) {
            $records =  AmenityProduct::where('amenity_id', $value)->select('property_id')->get();
            foreach ($records as $value) {
               array_push($ids, $value->property_id);
            }
         }
         $result = array_unique($ids);
         $query->whereIn('id', $result);
      })
      ->when(request('min_area') != 0 && request('max_area') != 0, function ($query) {
         $query->whereBetween('land_area', [(int)request()->get('min_area'), (int)request()->get('max_area')]);
      })
      ->when(request('min_area') != 0 && request('max_area') == 0, function ($query) {
         $query->where('land_area', '>=', [(int)request()->get('min_area')]);
      })
      ->when(request('min_area') == 0 && request('max_area') != 0, function ($query) {
         $query->where('land_area', '<=', [(int)request()->get('max_area')]);
      })
      ->when(isset($request->bedrooms) && !empty($request->bedrooms), function ($query) {
         if (request('bedrooms') == "6+") {
            $query->where('properties.bedrooms', '>=', 6);
         } else {
            $query->where('properties.bedrooms', request('bedrooms'));
         }
      })
      ->when(isset($request->bathrooms) && !empty($request->bathrooms), function ($query) {
         if (request('bathrooms') == "6+") {
            $query->where('properties.bathrooms', '>=', 6);
         } else {
            $query->where('properties.bathrooms', request('bathrooms'));
         }
      })
      ->when(request()->agent, function ($query) {
         $query->where('agency_id', request()->agent);
      });

      $commercialIds = array();
      array_push($commercialIds, '14', '17', '23', '27', '4', '13', '7', '34', '16', '35');

      if (isset($request->commercial)) {
         $properties->whereIn('property_type', $commercialIds);
      } elseif (!in_array(request('property_type'), $commercialIds)) {
         $properties->whereNotIn('property_type', $commercialIds);
      }

      return $properties = $properties->inRandomOrder()->limit(10)->paginate(getcong('pagination_limit'));

   }
   
   public function getNearbyPropertiesWithoutType(Request $request)
   {
      $properties = Properties::where('status', 1)
      ->when(request()->property_purpose, function ($query) {
         $query->where('property_purpose', request()->property_purpose);
      })
      ->when(request()->area, function ($query) {
         $query->where('town', request()->town);
      })
      ->when(request()->town, function ($query) {
         $query->where('subcity', request()->subcity);
      })
      ->when(request()->subcity, function ($query) {
         $query->where('city', request()->city);
      })
      ->when(request()->city, function ($query) {
         // $query->where('city', request()->city);
      })
      // ->when(request('property_type'), function ($query) {
      //    $query->where('property_type', request('property_type'));
      // })
      ->when(request('min_price') != 0 && request('max_price') != 0, function ($query) {
         $query->whereBetween('price', [(int)request()->get('min_price'), (int)request()->get('max_price')]);
      })
      ->when(request('min_price') != 0 && request('max_price') == 0, function ($query) {
         $query->where('price', '>=', [(int)request()->get('min_price')]);
      })
      ->when(request('min_price') == 0 && request('max_price') != 0, function ($query) {
         $query->where('price', '<=', [(int)request()->get('max_price')]);
      })
      ->when(request()->get('furnishings'), function ($query) {
         $query->where('property_features', 'like', '%' . request()->get('furnishings') . '%');
      })
      ->when(request()->get('amenities'), function ($query) {
         $ids = array();
         foreach (request()->get('amenities') as $value) {
            $records =  AmenityProduct::where('amenity_id', $value)->select('property_id')->get();
            foreach ($records as $value) {
               array_push($ids, $value->property_id);
            }
         }
         $result = array_unique($ids);
         $query->whereIn('id', $result);
      })
      ->when(request('min_area') != 0 && request('max_area') != 0, function ($query) {
         $query->whereBetween('land_area', [(int)request()->get('min_area'), (int)request()->get('max_area')]);
      })
      ->when(request('min_area') != 0 && request('max_area') == 0, function ($query) {
         $query->where('land_area', '>=', [(int)request()->get('min_area')]);
      })
      ->when(request('min_area') == 0 && request('max_area') != 0, function ($query) {
         $query->where('land_area', '<=', [(int)request()->get('max_area')]);
      })
      ->when(isset($request->bedrooms) && !empty($request->bedrooms), function ($query) {
         if (request('bedrooms') == "6+") {
            $query->where('properties.bedrooms', '>=', 6);
         } else {
            $query->where('properties.bedrooms', request('bedrooms'));
         }
      })
      ->when(isset($request->bathrooms) && !empty($request->bathrooms), function ($query) {
         if (request('bathrooms') == "6+") {
            $query->where('properties.bathrooms', '>=', 6);
         } else {
            $query->where('properties.bathrooms', request('bathrooms'));
         }
      })
      ->when(request()->agent, function ($query) {
         $query->where('agency_id', request()->agent);
      });

      $commercialIds = array();
      array_push($commercialIds, '14', '17', '23', '27', '4', '13', '7', '34', '16', '35');

      if (isset($request->commercial)) {
         $properties->whereIn('property_type', $commercialIds);
      } elseif (!in_array(request('property_type'), $commercialIds)) {
         $properties->whereNotIn('property_type', $commercialIds);
      }

      return $properties = $properties->limit(10)->paginate(getcong('pagination_limit'));

   }
}
