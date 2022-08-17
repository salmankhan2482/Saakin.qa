<?php

namespace App\Http\Controllers\Admin;

use App\Types;
use App\Agency;
use App\CityGuide;
use App\Properties;
use App\PropertyAreas;

use App\PropertyTowns;
use App\PropertyCities;
use App\PropertyAmenity;

use App\PropertyGallery;
use App\PropertyPurpose;
use App\PropertyDocument;
use App\PropertyFloorPlan;
use App\PropertySubCities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\PropertyNeighborhood;
use App\Exports\PropertiesExport;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\MainAdminController;
use Intervention\Image\ImageManagerStatic as Image;
use MicrosoftAzure\Storage\Table\Models\Property;

class PropertiesController extends MainAdminController
{
   public function __construct()
   {
      $this->middleware('auth');
      $this->middleware('permission:properties-list', ['only' => ['index','inactivepropertieslist']]);
      $this->middleware('permission:properties-create', ['only' => ['create','store']]);
      $this->middleware('permission:properties-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:properties-delete', ['only' => ['delete']]);
      
      $this->middleware('permission:gallery-images-list', ['only' => ['listGalleryImages']]);
      $this->middleware('permission:gallery-images-create', ['only' => ['addGalleryImages','storeGalleryImages']]);
      $this->middleware('permission:gallery-images-edit', ['only' => ['editGalleryImages','updateGalleryImages']]);
      $this->middleware('permission:gallery-images-delete', ['only' => ['destroyGalleryImages']]);
      
      $this->middleware('permission:neighbor-hood-list', ['only' => ['listNeighbourhood']]);
      $this->middleware('permission:neighbor-hood-create', ['only' => ['storeNeighbourhood']]);
      $this->middleware('permission:neighbor-hood-edit', ['only' => ['editNeighbourhood','updateNeighbourhood']]);
      $this->middleware('permission:neighbor-hood-delete', ['only' => ['destroyNeighbourhood']]);
      
      $this->middleware('permission:floor-plan-list', ['only' => ['listFloorPlan']]);
      $this->middleware('permission:floor-plan-create', ['only' => ['storeFloorPlan']]);
      $this->middleware('permission:floor-plan-edit', ['only' => ['editFloorPlan','updateFloorPlan']]);
      $this->middleware('permission:floor-plan-delete', ['only' => ['destroyFloorPlan']]);
      
      $this->middleware('permission:properties-plan-update', ['only' => ['plan_update']]);
      $this->middleware('permission:delete-featured-property-image', ['only' => ['featuredproperty','deleteFeaturedImage']]);
      parent::__construct();
   }

   public function index()
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('dashboard');
      }

      $data['propertieslist'] = Properties::when(request('purpose'), function ($query) {
            return $query->where('property_purpose', request('purpose'));
         })
         ->when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where('agency_id', auth()->user()->agency_id);
         })
         ->when(request('type'), function ($query) {
            return $query->where('property_type', request('type'));
         })
         ->when(request('keyword'), function ($query) {
            return $query->where('property_name','like', '%'. request('keyword') . '%');
         })
         ->when(request('status'), function ($query) {
            return $query->where('status', request('status'));
         })
         ->when(request('keyword'), function ($query) {
            return $query->orWhere('id', request('keyword'));
         })
         ->when(auth()->user()->usertype == "Agency", function ($query) {
            return $query->where('agency_id', auth()->user()->agency_id);
         })
         ->where('status', 1)->orderBy('id', 'desc')->paginate(15);

      $data['propertieslist']->appends($_GET)->links();

      $data['propertyTypes'] = Types::join("properties", "properties.property_type", "=", "property_types.id")
         ->select("property_types.id", "property_types.types", DB::Raw("count(properties.id) as pcount"))
         ->when(auth()->user()->usertype == "Agency", function ($query) {
            return $query->where('properties.agency_id', Auth::User()->agency_id);
         })->where('properties.status', 1)
         ->orderBy("pcount", "desc")
         ->groupBy("property_types.id")->get();


      $action = 'saakin_index';
      return view('admin-dashboard.properties.index', compact('data', 'action'));
   }

   public function inactivepropertieslist()
   {
      $data['propertieslist'] = Properties::when(request('purpose'), function ($query) {
            return $query->where('property_purpose', request('purpose'));
         })
         ->when(request('type'), function ($query) {
            return $query->where('property_type', request('type'));
         })
         ->when(auth()->user()->usertype == 'Agency', function ($query) {
            $query->where('agency_id', auth()->user()->agency_id);
         })
         ->when(request('keyword'), function ($query) {
            return $query->where('property_name', 'like', '%'. request('keyword') . '%');
         })
         ->when(request('status'), function ($query) {
            return $query->where('status', request('status'));
         })
         ->when(request('keyword'), function ($query) {
            return $query->orWhere('id', request('keyword'));
         })
         ->when(auth()->user()->usertype == "Agency", function ($query) {
            return $query->where('agency_id', auth()->user()->agency_id);
         })
         ->where('status', 0)->orderBy('id', 'desc')->paginate(15);

      $data['propertieslist']->appends($_GET)->links();

      $data['propertyTypes'] = Types::join("properties", "properties.property_type", "=", "property_types.id")
         ->select("property_types.id", "property_types.types", DB::Raw("count(properties.id) as pcount"))
         ->when(auth()->user()->usertype == "Agency", function ($query) {
            return $query->where('properties.agency_id', Auth::User()->agency_id);
         })
         ->where('properties.status', 0)->orderBy("pcount", "desc")->groupBy("property_types.id")->get();

      $action = 'saakin_index';
      return view('admin-dashboard.properties.inactive_properties_index', compact('data', 'action'));
   }

   public function create()
   {

      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      $data['types'] = Types::orderBy('types')->get();
      $data['purposes'] = PropertyPurpose::get();
      $data['cityguides'] = CityGuide::get();
      $data['amenities'] = PropertyAmenity::orderBy("name", "asc")->get();
      $data['agencies'] = Agency::where('status', 1)->get();

      $data['cities'] = PropertyCities::all();
      $data['subCities'] = PropertySubCities::all();
      $data['towns'] = PropertyTowns::all();
      $data['areas'] = PropertyAreas::all();

      $action = 'saakin_create';
      return view('admin-dashboard.properties.create',  compact('data', 'action'));
   }

   public function store(Request $request)
   {
      if (Properties::where('property_name', request('property_name'))->first()) {
         return redirect()->back()->withErrors(['msg' => 'Duplicate Record Cannot be Inserted.']);
      }

      $request_data = request()->all();
      if ($request->city == '') {
         return redirect()->back()->withErrors(['msg' => 'City Must be Selected.']);
      }

      if ($request->city) {
         $city = PropertyCities::where('id', $request->city)->value('name');
      } else {
         $city = '';
      }

      if ($request->subcity) {
         $subcity = PropertySubCities::where('id', $request->subcity)->value('name');
      } else {
         $subcity = '';
      }

      if ($request->town) {
         $town = PropertyTowns::where('id', $request->town)->value('name');
      } else {
         $town = '';
      }

      if ($request->area) {
         $area = PropertyAreas::where('id', $request->area)->value('name');
      } else {
         $area = '';
      }

      $address_without_slug = $subcity . ' ' . $town . ' ' . $area;
      $address_slug = Str::slug($address_without_slug);

      $type = Types::where('id', $request->property_type)->first();

      if ($subcity == $town) {
         $property_slug = strtolower($type->slug . '-for-' . $request->property_purpose . '-' . Str::slug($city . '-' . $subcity . '-' . $area));
      } else {
         $property_slug = strtolower($type->slug . '-for-' . $request->property_purpose . '-' . Str::slug($city . '-' . $subcity . '-' . $town . '-' . $area));
      }

      $request_data['user_id'] = Auth::user()->id;
      $request_data['status'] = 0;

      if (Auth::user()->usertype == 'Admin') {
         $request_data['agency_id'] = $request_data['agency_id'];
      } else {
         $request_data['agency_id'] = Auth::user()->agency_id;
      }

      $request_data['refference_code'] = $request_data['reference_code'];
      $request_data['property_slug'] = $property_slug;
      $request_data['rooms'] = request()->rooms;
      $request_data['sub_city'] = $request_data['subcity'];
      $request_data['town'] = $request->town;
      $request_data['area'] = $request->area;
      $request_data['map_latitude'] = $request_data['map_latitude'];
      $request_data['map_longitude'] = $request_data['map_longitude'];
      $featured_image = $request->file('featured_image');

      if ($featured_image) {
         $tmpFilePath = public_path('upload/properties/');
         $name = 'property_' . time() . '.' . $featured_image->extension();
         $featured_image->move($tmpFilePath, $name);
         $request_data['featured_image'] = $name;

         //Image resizeing
         $image_original_path = $tmpFilePath . $name;
         $image_resize = Image::make($image_original_path);
         $image_resize->resize(275, 205);
         $resize = $tmpFilePath . 'thumb_' . $name;
         $image_resize->save($resize);
         $image_resize->resize('135', '180')
         ->save(public_path() . '/upload/m_properties/' . 'mobile_thumb_' . $name);
      }

      $agent_picture = $request->file('agent_picture');
      if ($agent_picture) {

         $tmpFilePath = public_path('upload/properties/');
         $agent_name = 'agent_' . time() . '.' . $agent_picture->extension();
         $agent_picture->move($tmpFilePath, $agent_name);
         $request_data['agent_picture'] = $agent_name;
      }

      $property = Properties::create($request_data);
      $reference = $request_data['refference_code'];
      
      $pro = Properties::find($property->id);
      if (request('property_amenities')) {
         $pro->amenities()->attach($request->property_amenities);
      }

      $pro->refference_code = $reference;
      $pro->subcity = request('subcity');
      $pro->town = request('town');
      $pro->address_slug = $address_slug;
      $pro->city = $request->city;

      if ($request->subcity) {
         $pro->sub_city_slug = strtolower($type->plural . '-for-' . $request->property_purpose . '-' . Str::slug($subcity));
         $pro->subcity = $request->subcity;
      }
      if ($request->town) {
         $pro->town_slug = strtolower($type->plural . '-for-' . $request->property_purpose . '-' . Str::slug($subcity . '-' . $town));
         $pro->town = $request->town;
      }
      if ($request->area) {
         $pro->area_slug = strtolower($type->plural . '-for-' . $request->property_purpose . '-' . Str::slug($subcity . '-' . $town . '-' . $area));
         $pro->area = $request->area;
      }

      $pro->address = $address_without_slug;
      $pro->update();

      $property_gallery_files = $request->file('images');
      $gallery_image_path = public_path('upload/gallery');
      $galcount = 0;
      
      if ($property_gallery_files) {
         foreach ($property_gallery_files as $file) {
            $galcount++;
            $property_gallery_obj = new PropertyGallery;
            $name = 'property_' . $galcount . time() . '.' . $file->extension();

            $img = Image::make($file->getRealPath());
            $img->resize(861, 608, function ($constraint) {
               $constraint->aspectRatio();
            })->save($gallery_image_path . '/' . $name);
            $img->resize('135', '180')->save(public_path() . '/upload/m_gallery/' . 'mobile_' . $name);

            // remove the down line of move to resize the image

            $file->move($gallery_image_path, $name);
            $property_gallery_obj->property_id = $property->id;
            $property_gallery_obj->image_name = $name;
            $property_gallery_obj->save();
            unset($name, $gallery_image_name);
         }
      }


      if ($request->hasfile('property_document')) {
         $property_document_path = public_path('upload/documents/');
         foreach ($request->file('property_document') as $file) {
            $property_document_obj = new PropertyDocument;
            $property_document_name = $file->getClientOriginalName();
            $property_document_name = explode(".", $property_document_name);
            $name = $property_document_name[0] . '_' . time() . '.' . $file->extension();
            $file->move($property_document_path, $name);

            $property_document_obj->property_id = $property->id;
            $property_document_obj->doc_images = $name;
            $property_document_obj->save();
         }
      }

      $property->meta_title = $request->meta_title;
      $property->meta_description = $request->meta_description;
      $property->meta_keyword = $request->meta_keyword;
      $property->save();

      \Session::flash('flash_message', "Your Property has been submitted. It will be Publish soon");
      return redirect()->route('properties.index');
   }

   public function edit(Request $request, $id)
   {

      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      $data['property'] = Properties::findOrFail($id);

      if (!$data['property']) {
         abort('404');
      }
      $data['cityguides'] = CityGuide::get();
      $data['types'] = Types::orderBy('types')->get();
      $data['purposes'] = PropertyPurpose::get();
      $data['amenities'] = PropertyAmenity::orderBy("name", "asc")->get();
      $data['agencies'] = Agency::where('status', 1)->get();

      $data['property_gallery_images'] = PropertyGallery::where('property_id', $id)
         ->orderBy('image_name')->pluck('image_name');
      $data['cities'] = PropertyCities::all();
      $data['subCities'] = PropertySubCities::all();
      $data['towns'] = PropertyTowns::all();
      $data['areas'] = PropertyAreas::all();
      $action = 'saakin_create';

      return view('admin-dashboard.properties.edit', compact('data', 'action'));
   }

   public function update(Request $request, $id)
   {
      $request_data = request()->all();
      $property = Properties::where('id', $id)->firstOrFail();

      if ($request->city) {
         $city = PropertyCities::where('id', $request->city)->value('name');
      } else {
         $city = '';
      }

      if ($request->subcity) {
         $subcity = PropertySubCities::where('id', $request->subcity)->value('name');
      } else {
         $subcity = '';
      }

      if ($request->town) {
         $town = PropertyTowns::where('id', $request->town)->value('name');
      } else {
         $town = '';
      }

      if ($request->area) {
         $area = PropertyAreas::where('id', $request->area)->value('name');
      } else {
         $area = '';
      }

      $address_without_slug = $subcity . ' ' . $town . ' ' . $area;
      $address_slug = Str::slug($address_without_slug);

      $type = Types::where('id', $request->property_type)->first();

      if ($subcity == $town) {
         $property_slug = strtolower($type->slug . '-for-' . $request->property_purpose . '-' . Str::slug($city . '-' . $subcity . '-' . $area));
      } else {
         $property_slug = strtolower($type->slug . '-for-' . $request->property_purpose . '-' . Str::slug($city . '-' . $subcity . '-' . $town . '-' . $area));
      }

      $request_data =  \Request::except(array('_token'));
      $rule = array( 'property_name' => 'required' );

      $validator = \Validator::make($request_data, $rule);
      if ($validator->fails()) {
         return redirect()->back()->withErrors($validator->messages());
      }
      $request_data['refference_code'] = $request_data['reference_code'];
      $request_data['address_slug'] = $address_slug;
      $request_data['address'] = $address_without_slug;
      $request_data['property_slug'] = $property_slug;
      $request_data['meta_title'] = $request->meta_title;
      $request_data['meta_description'] = $request->meta_description;
      $request_data['meta_keyword'] = $request->meta_keyword;

      $featured_image = $request->file('featured_image');

      if ($featured_image) {
         
         File::delete(public_path() . '/upload/properties/' . $property->featured_image);// deleting thumb & featured properties folder desktop
         File::delete(public_path() . '/upload/properties/thumb_' . $property->featured_image);
         File::delete(public_path() . '/upload/m_properties/mobile_thumb_' . $property->featured_image); // deleting thumb or featured image from m_properties

         $tmpFilePath = public_path('upload/properties/');
         $name = 'property_' . time() . '.' . $featured_image->extension();
         $featured_image->move($tmpFilePath, $name);
         $request_data['featured_image'] = $name;
         //Image resizeing
         $image_original_path = $tmpFilePath . $name;
         $image_resize = Image::make($image_original_path);
         $image_resize->resize(275, 205);
         $resize = $tmpFilePath . 'thumb_' . $name;
         $image_resize->resize('135', '180')->save(public_path() . '/upload/m_properties/' . 'mobile_thumb_' . $name);
         $image_resize->save($resize);
         
      }else{
         // check if the agent pic does not exist in mbl folder then copy it from pc folder
         if (!file_exists(public_path() . '/upload/m_properties/mobile_thumb_' . $property->featured_image)) {
            $img = Image::make(file_get_contents(public_path() . '/upload/properties/thumb_' . $property->featured_image));
            $img->resize('135', '180')->save(public_path() . '/upload/m_properties/mobile_thumb_' . $property->featured_image);
         } 
      }

      $agent_picture = $request->file('agent_picture');
      if ($agent_picture) {
         
         File::delete(public_path() . '/upload/properties/' . $property->agent_picture);// deleting agent pic for desktop
         $tmpFilePath = public_path('upload/properties/');
         $agent_name = 'agent_' . time() . '.' . $agent_picture->extension();
         $agent_picture->move($tmpFilePath, $agent_name);
         $request_data['agent_picture'] = $agent_name;
      }

      $property_gallery_files = $request->file('images');
      $gallery_image_path = public_path('upload/gallery');
      $property_gallery_images = PropertyGallery::where('property_id', $property->id)->get();
      
      // check if the file doesnot exist in the m_gallery then get from the folder and save it in m_gallery
      foreach ($property_gallery_images as $gallery_image) {
         if (!file_exists(public_path() . '/upload/m_gallery/mobile_' . $gallery_image->image_name)) {
            $img = Image::make(file_get_contents($gallery_image_path . DIRECTORY_SEPARATOR . $gallery_image->image_name));
            $img->resize('135', '180')->save(public_path() . '/upload/m_gallery/' . 'mobile_' . $gallery_image->image_name);
         }  
      }

      $galcount = 0;
      if ($property_gallery_files) {

         //deleting images for desktop and mobile
         foreach ($property_gallery_images as $gallery_images) {
               File::delete($gallery_image_path .DIRECTORY_SEPARATOR. $gallery_images->image_name);
               File::delete(public_path() . '/upload/m_gallery/mobile_' . $gallery_images->image_name);
               $property_gallery_obj = PropertyGallery::findOrFail($gallery_images->id);
               $property_gallery_obj->delete();
         }
         
         foreach ($property_gallery_files as $file) {
            $galcount++;
            $property_gallery_obj = new PropertyGallery;
            $name = 'property_' . $galcount . time() . '.' . $file->extension();
            $img = Image::make($file->getRealPath());
            $img->resize(861, 608, function ($constraint) {
               $constraint->aspectRatio();
            })->save($gallery_image_path . '/' . $name);
            $img->resize('135', '180')->save(public_path() . '/upload/m_gallery/' . 'mobile_' . $name);

            // remove the down line of move to resize the image

            $file->move($gallery_image_path, $name);
            $property_gallery_obj->property_id = $property->id;
            $property_gallery_obj->image_name = $name;
            $property_gallery_obj->save();
            unset($name, $gallery_image_name);
         }
      }

      $property->update($request_data);

      if ($request->subcity) {
         $sub_city_slug = strtolower($type->plural . '-for-' . $request->property_purpose . '-' . Str::slug($subcity));
         $property->sub_city_slug = $sub_city_slug;
         
      } else {
         $property->sub_city_slug = '';
      }

      if ($request->town) {
         $town_slug = strtolower($type->plural . '-for-' . $request->property_purpose . '-' . Str::slug($subcity . '-' . $town));
         $property->town_slug = $town_slug;
      } else {
         $property->town_slug = '';
      }

      if ($request->area) {
         $area_slug = strtolower($type->plural . '-for-' . $request->property_purpose . '-' . Str::slug($subcity . '-' . $town . '-' . $area));
         $property->area_slug = $area_slug;
      } else {
         $property->area_slug = '';
      }

      $property->city = $request->city;
      $property->subcity = $request->subcity;
      $property->town = $request->town;
      $property->area = $request->area;
      $property->update();
      $property->amenities()->sync($request->property_amenities);

      \Session::flash('flash_message', trans('words.updated'));
      return \Redirect::back();
   }

   public function show($id)
   {
      $property = Properties::where('id', $id)->first();
      $agency = Agency::where('id', $property->agency_id)->first();
      $property_gallery_images = PropertyGallery::where('property_id', $id)->get();
      $action = 'saakin_index';
      return view('admin-dashboard.properties.show',compact('action','property','agency','property_gallery_images'));
   }

   public function plan_update(Request $request)
   {
      $prop = Properties::findOrFail(request('property_id'));
      $prop->active_plan_id = request('plan_id');
      $prop->property_exp_date = strtotime(request('property_exp_date'));
      $prop->save();

      \Session::flash('flash_message', 'Plan updated successfully!');
      return redirect()->back();
   }

   public function delete($id)
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         Session::flash('flash_message', trans('words.access_denied'));
         return redirect('dashboard');
      }

      $decrypted_id = Crypt::decryptString($id);
      $property = Properties::findOrFail($decrypted_id);

      // if (Auth::User()->usertype == "Admin") {

      //    File::delete(public_path() . '/upload/properties/' . $property->featured_image);
      //    File::delete(public_path() . '/upload/m_properties/mobile_thumb_' . $property->featured_image);
      //    File::delete(public_path() . '/upload/floorplan/' . $property->floor_plan);
      //    $property->delete();
      //    $property->amenities()->detach();

      //    $property_gallery_images = PropertyGallery::where('property_id', $decrypted_id)->get();

      //    foreach ($property_gallery_images as $gallery_images) {
      //       File::delete(public_path() . '/upload/gallery/' . $gallery_images->image_name);
      //       File::delete(public_path() . '/upload/m_gallery/mobile_' . $gallery_images->image_name);
      //       $property_gallery_obj = PropertyGallery::findOrFail($gallery_images->id);
      //       $property_gallery_obj->delete();
      //    }

      //    Session::flash('flash_message', trans('words.deleted'));
      //    return redirect()->back();

      // } elseif (Auth::User()->usertype == "Agency") {
      //    if (Auth::User()->id != $property->user_id and Auth::User()->usertype != "Admin") {
      //       Session::flash('flash_message', trans('words.access_denied'));
      //       return redirect('admin/dashboard');
      //    }

         if ($property->status == 1) {
            $property->status = '0';
            $property->remove_reason = request('reason') ?? '';
            $property->save();
            Session::flash('flash_message', "Property Removed .");
            return redirect()->back();
         } else {
            $property->status = '1';
            $property->remove_reason = '';
            $property->save();
            Session::flash('flash_message', "Property Published .");
            return redirect()->back();
         }
      // }
   }


   public function status($id)
   {
      $decrypted_id = Crypt::decryptString($id);
      $property = Properties::findOrFail($decrypted_id);

      if (Auth::User()->id != $property->user_id && Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));

         return redirect('admin/dashboard');
      }

      if ($property->status == 1) {
         $property->status = '0';
         $property->remove_reason = request('reason');
         $property->save();

         \Session::flash('flash_message', trans('words.unpublish'));
      } else {
         $property->status = '1';
         $property->remove_reason = '';
         $property->save();

         \Session::flash('flash_message', trans('words.published'));
      }

      return redirect()->back();
   }

   public function featuredproperty($id)
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));

         return redirect('admin/dashboard');
      }

      $decrypted_id = Crypt::decryptString($id);
      $property = Properties::findOrFail($decrypted_id);

      if ($property->featured_property == 1) {
         $property->featured_property = '0';
         $property->save();

         \Session::flash('flash_message', trans('words.property_unset_from_featured'));
      } else {
         $property->featured_property = '1';
         $property->save();

         \Session::flash('flash_message', trans('words.property_set_as_featured'));
      }

      return redirect()->back();
   }

   public function property_export()
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {

         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      return Excel::download(new PropertiesExport, 'properties.xlsx');
   }


   public function listGalleryImages($property_id)
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      $property_name = Properties::where('id', $property_id)->pluck('property_name')->first();
      $galleryImages = PropertyGallery::where('property_id', $property_id)->get();
      $action = 'saakin_index';
      return view('admin-dashboard.properties.gallery', compact('property_id', 'property_name', 'galleryImages', 'action'));
   }

   public function addGalleryImages($property_id)
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      return view('admin.pages.add_property_gallery_image', compact('property_id'));
   }


   public function storeGalleryImages(Request $request, $property_id)
   {
      $property_gallery_files = $request->file('images');
      if ($property_gallery_files) {
         foreach ($property_gallery_files as $file) {
            $property_gallery_obj = new PropertyGallery;
            $gallery_image_path = public_path('upload/gallery/');
            $gallery_image_name = $file->getClientOriginalName();
            $gallery_image_name = explode(".", $gallery_image_name);
            $name = $gallery_image_name[0] . '_' . time() . '.' . $file->extension();

            //Image Resize
            $img = Image::make($file->getRealPath());
            $img->resize(861, 608, function ($constraint) {
               $constraint->aspectRatio();
            })->save($gallery_image_path . '/' . $name);

            $file->move($gallery_image_path, $name);
            $property_gallery_obj->property_id = $property_id;
            $property_gallery_obj->image_name = $name;
            $property_gallery_obj->save();
         }
         \Session::flash('flash_message', trans('words.added'));
         return \Redirect::back();
      }
   }

   public function editGalleryImages($property_id, $gid)
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      $propertyGallery = PropertyGallery::findOrFail($gid);
      if (!$propertyGallery) {
         abort('404');
      }

      $property_name = Properties::where('id', $property_id)->pluck('property_name')->first();
      $property_gallery_image = PropertyGallery::where('id', $gid)->first();
      $galleryImages = PropertyGallery::where('property_id', $property_id)->get();

      return view('admin.pages.property_gallery_images', compact('gid', 'property_id', 'property_name', 'property_gallery_image', 'galleryImages'));

   }

   public function updateGalleryImages(Request $request, $property_id, $gid)
   {

      $request_data = request()->all();

      $gallery_image = $request->file('gallery_image');
      if ($gallery_image) {
         $gallery_image_name = $gallery_image->getClientOriginalName();
         $gallery_image_name = explode(".", $gallery_image_name);
         $tmpFilePath = public_path('upload/gallery/');
         $imageName = $gallery_image_name[0] . '_' . time() . '.' . $gallery_image->extension();
         $gallery_image->move($tmpFilePath, $imageName);
         $request_data['gallery_image'] = $imageName;

         $property_gallery_image_obj = PropertyGallery::findorfail($gid);
         $property_gallery_image_obj->property_id = $property_id;
         $property_gallery_image_obj->image_name = $request_data['gallery_image'];
         $property_gallery_image_obj->save();
      }

      \Session::flash('flash_message', trans('words.updated'));
      return \Redirect::back();
   }

   public function destroyGalleryImages($property_id, $gid)
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      $property_gallery_images = PropertyGallery::where('id', $gid)->first();
      \File::delete(public_path() . '/upload/gallery/' . $property_gallery_images->image_name);
      $galleryImage = PropertyGallery::findOrFail($gid);
      $galleryImage->delete();

      \Session::flash('flash_message', trans('words.deleted'));

      return redirect()->back();
   }

   ///////////////////////////////////// neighbourhood /////////////////////////////////////////

   public function listNeighbourhood($property_id)
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      $property_name = Properties::where('id', $property_id)->pluck('property_name')->first();

      $neighbourhoods = PropertyNeighborhood::where('property_id', $property_id)->get();
      return view('admin.pages.property_neighbourhood', compact('property_id', 'property_name', 'neighbourhoods'));
   }

   public function storeNeighbourhood(Request $request, $property_id)
   {
      $request_data = request()->all();
      $rule = array(
         'category_name' => 'required',
         'title' => 'required',
         'distance' => 'required',
      );

      $validator = \Validator::make($request_data, $rule);

      if ($validator->fails()) {
         return redirect()->back()->withErrors($validator->messages());
      }

      $property_neighbour_obj = new PropertyNeighborhood();
      $property_neighbour_obj->property_id = $property_id;
      $property_neighbour_obj->category_name = $request_data['category_name'];
      $property_neighbour_obj->title = $request_data['title'];
      $property_neighbour_obj->distance = $request_data['distance'];
      $property_neighbour_obj->save();

      \Session::flash('flash_message', trans('words.added'));
      return \Redirect::back();
   }

   public function editNeighbourhood($property_id, $neighbourhood_id)
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      $propertyNeighbourhood = PropertyNeighborhood::findOrFail($neighbourhood_id);
      if (!$propertyNeighbourhood) {
         abort('404');
      }

      $property_name = Properties::where('id', $property_id)->pluck('property_name')->first();
      $property_neighbourhood = PropertyNeighborhood::where('id', $neighbourhood_id)->first();
      $neighbourhoods = PropertyNeighborhood::where('property_id', $property_id)->get();
      return view('admin.pages.property_neighbourhood', compact('neighbourhood_id', 'property_id', 'property_name', 'property_neighbourhood', 'neighbourhoods'));
   }

   public function updateNeighbourhood(Request $request, $property_id, $neighbourhood_id)
   {
      $request_data = request()->all();
      $property_neighbour_obj = PropertyNeighborhood::findOrFail($neighbourhood_id);
      $property_neighbour_obj->property_id = $property_id;
      $property_neighbour_obj->category_name = $request_data['category_name'];
      $property_neighbour_obj->title = $request_data['title'];
      $property_neighbour_obj->distance = $request_data['distance'];
      $property_neighbour_obj->save();

      \Session::flash('flash_message', trans('words.updated'));
      return \Redirect::back();
   }

   public function destroyNeighbourhood($property_id, $gid)
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      $property_gallery_images = PropertyGallery::where('id', $gid)->first();
      \File::delete(public_path() . '/upload/gallery/' . $property_gallery_images->image_name);
      $galleryImage = PropertyGallery::findOrFail($gid);
      $galleryImage->delete();

      \Session::flash('flash_message', trans('words.deleted'));
      return redirect()->back();
   }

   public function listFloorPlan($property_id)
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }
      $property_name = Properties::where('id', $property_id)->pluck('property_name')->first();
      $floorPlans = PropertyFloorPlan::where('property_id', $property_id)->get();
      return view('admin.pages.property_floor_plan', compact('property_id', 'property_name', 'floorPlans'));
   }

   public function storeFloorPlan(Request $request, $property_id)
   {
      $request_data = request()->all();
      $rule = array(
         'floor_name' => 'required',
         'floor_size' => 'required',
         'floor_rooms' => 'required',
         'floor_bathrooms' => 'required',
         'floor_image' => 'required',
      );
      $validator = \Validator::make($request_data, $rule);
      if ($validator->fails()) {
         return redirect()->back()->withErrors($validator->messages());
      }

      $floor_image = $request->file('floor_image');
      if ($floor_image) {
         $floor_image_name = $floor_image->getClientOriginalName();
         $floor_image_name = explode(".", $floor_image_name);
         $tmpFilePath = public_path('upload/floorplan/');
         $imageName = $floor_image_name[0] . '_' . time() . '.' . $floor_image->extension();
         $floor_image->move($tmpFilePath, $imageName);
         $request_data['floor_image'] = $imageName;
      }

      $property_floorplan_obj = new PropertyFloorPlan();
      $property_floorplan_obj->property_id = $property_id;
      $property_floorplan_obj->floor_name = $request_data['floor_name'];
      $property_floorplan_obj->floor_size = $request_data['floor_size'];
      $property_floorplan_obj->floor_rooms = $request_data['floor_rooms'];
      $property_floorplan_obj->floor_bathrooms = $request_data['floor_bathrooms'];
      $property_floorplan_obj->floor_images = $request_data['floor_image'];
      $property_floorplan_obj->save();

      \Session::flash('flash_message', trans('words.added'));
      return \Redirect::back();
   }

   public function editFloorPlan($property_id, $floor_plan_id)
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      $propertyfloorPlan = PropertyFloorPlan::findOrFail($floor_plan_id);

      if (!$propertyfloorPlan) {
         abort('404');
      }

      $property_name = Properties::where('id', $property_id)->pluck('property_name')->first();
      $propertyFloorPlan = PropertyFloorPlan::where('id', $floor_plan_id)->first();
      $floorPlans = PropertyFloorPlan::where('property_id', $property_id)->get();
      return view('admin.pages.property_floor_plan', compact('floor_plan_id', 'property_id', 'property_name', 'propertyFloorPlan', 'floorPlans'));
   }

   public function updateFloorPlan(Request $request, $property_id, $floor_plan_id)
   {
      $request_data = request()->all();
      $property_floorplan_obj = PropertyFloorPlan::findOrFail($floor_plan_id);

      $floor_image = $request->file('floor_image');
      if ($floor_image) {
         $floor_image_name = $floor_image->getClientOriginalName();
         $floor_image_name = explode(".", $floor_image_name);
         $tmpFilePath = public_path('upload/floorplan/');
         $imageName = $floor_image_name[0] . '_' . time() . '.' . $floor_image->extension();
         $floor_image->move($tmpFilePath, $imageName);
         $request_data['floor_image'] = $imageName;

         $property_floorplan_obj->floor_images = $request_data['floor_image'];
      }

      $property_floorplan_obj->property_id = $property_id;
      $property_floorplan_obj->floor_name = $request_data['floor_name'];
      $property_floorplan_obj->floor_size = $request_data['floor_size'];
      $property_floorplan_obj->floor_rooms = $request_data['floor_rooms'];
      $property_floorplan_obj->floor_bathrooms = $request_data['floor_bathrooms'];
      $property_floorplan_obj->save();

      \Session::flash('flash_message', trans('words.updated'));
      return \Redirect::back();
   }

   public function destroyFloorPlan($property_id, $floor_plan_id)
   {
      if (Auth::User()->usertype != "Admin" && Auth::User()->usertype != "Agency") {
         \Session::flash('flash_message', trans('words.access_denied'));
         return redirect('admin/dashboard');
      }

      $property_floorplan_images = PropertyFloorPlan::where('id', $floor_plan_id)->first();
      \File::delete(public_path() . '/upload/floorplan/' . $property_floorplan_images->floor_images);
      $floorPlanImage = PropertyFloorPlan::findOrFail($floor_plan_id);
      $floorPlanImage->delete();

      \Session::flash('flash_message', trans('words.deleted'));

      return redirect()->back();
   }
   
   public function deleteFeaturedImage()
   {
      $id = request('property_id');
      $pos = request('pos');
      $property = Properties::find($pos);
      unlink(public_path('upload/properties/') . $property->featured_image);
      $property->featured_image = "";
      $property->save();
      return "success";
   }

   public function generatethumb()
   {
      $properties = Properties::get();
      foreach ($properties as $property) {
         if (!empty($property->featured_image)) {
            $tmpFilePath = public_path('upload/properties/');
            $imageName = $property->featured_image;
            $fullImage = $tmpFilePath . $imageName;
            $image_resize = Image::make($fullImage);
            $image_resize->resize(383, 251);
            $iis = $tmpFilePath . 'thumb_' . $imageName;
            $image_resize->save($iis);
         }
      }
   }
}
