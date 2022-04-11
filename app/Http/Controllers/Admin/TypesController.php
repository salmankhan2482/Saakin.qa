<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Properties;
use App\PropertyGallery;
use App\Enquire;
use App\Types;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypesController extends MainAdminController
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }
    public function index()
    {
        if (Auth::User()->usertype != "Admin") {
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }
        $data['alltypes'] = Types::orderBy('id')->paginate(10);
        $action = 'saakin_index';
        return view('admin-dashboard.property-types.index', compact('data', 'action'));
    }

    public function create()
    {
        if (Auth::User()->usertype != "Admin") {
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }
        $action = 'saakin_create';
        return view('admin-dashboard.property-types.create', compact('action'));
    }

    public function store(Request $request)
    {
        $data =  \Request::except(array('_token'));
        $inputs = $request->all();
        $rule = array( 'property_type' => 'required' );
        $validator = \Validator::make($data, $rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        if (!empty($inputs['id'])) {
            $types = Types::findOrFail($inputs['id']);
        } else {
            $types = new Types;
        }
        $slug  = Str::slug($inputs['property_type'], "-");
        $types->types = $inputs['property_type'];
        $types->slug = $slug;
        $types->save();

        if (!empty($inputs['id'])) {
            \Session::flash('flash_message', trans('words.successfully_updated'));
            return \Redirect::back();
        } else {
            \Session::flash('flash_message', trans('words.added'));
            return \Redirect::back();
        }
    }

    public function edit($id)
    {
        if (Auth::User()->usertype != "Admin") {
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $data['type'] = Types::findOrFail($id);
        $action = 'saakin_create';

        return view('admin-dashboard.property-types.edit', compact('data', 'action'));
    }

    public function update(Request $request)
    {
        $data =  \Request::except(array('_token'));
        $inputs = $request->all();
        $rule = array( 'property_type' => 'required' );
        $validator = \Validator::make($data, $rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        if (!empty($inputs['id'])) {
            $types = Types::findOrFail($inputs['id']);
        } else {
            $types = new Types;
        }
        $slug  = Str::slug($inputs['property_type'], "-");
        $types->types = $inputs['property_type'];
        $types->slug = $slug;
        $types->save();

        if (!empty($inputs['id'])) {
            \Session::flash('flash_message', trans('words.successfully_updated'));
            return \Redirect::back();
        } else {
            \Session::flash('flash_message', trans('words.added'));
            return \Redirect::back();
        }
    }

    public function delete($id)
    {

        if (Auth::User()->usertype != "Admin") {
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $property_list = Properties::where('property_type', $id)->get();
        foreach ($property_list as $property_data) {
            $property_gallery_images = PropertyGallery::where('property_id', $property_data->id)->get();
            foreach ($property_gallery_images as $gallery_images) {

                \File::delete(public_path() . '/upload/gallery/' . $gallery_images->image_name);
                $property_gallery_obj = PropertyGallery::findOrFail($gallery_images->id);
                $property_gallery_obj->delete();
            }

            $property = Properties::findOrFail($property_data->id);

            \File::delete(public_path() . '/upload/properties/' . $property->featured_image . '-b.jpg');
            \File::delete(public_path() . '/upload/properties/' . $property->featured_image . '-s.jpg');

            \File::delete(public_path() . '/upload/floorplan/' . $property->floor_plan . '-b.jpg');
            \File::delete(public_path() . '/upload/floorplan/' . $property->floor_plan . '-s.jpg');

            $property->delete();
        }


        $type = Types::findOrFail($id);
        $type->delete();
        \Session::flash('flash_message', trans('words.deleted'));
        return redirect()->back();
    }
}
