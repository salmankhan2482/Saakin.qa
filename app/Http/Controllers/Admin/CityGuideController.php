<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use App\City;

use App\CityDetail;
use App\Http\Requests;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityGuideController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }

        $cities = City::paginate(10);
        
        $action = 'saakin_index';

        return view('admin-dashboard.city-guide.index',compact('cities','action'));
    }

    public function create()    {

        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }
        $action = 'saakin_create';

        return view('admin-dashboard.city-guide.create',compact('action'));
    }
  public function show($id)    {

        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }
         $cityGuide = City::where('id',$id)->where('status',1)->first();
        $cityGuideDetails = CityDetail::where('city_id',$id)->where('status',1)->get();

        return view('admin.pages.city_show',compact('cityGuide','cityGuideDetails'));
    }
    public function store(Request $request)
    {
        $data =  \Request::except(array('_token')) ;
        $inputs = $request->all();
        $rule=array(
            'name' => 'required',
            'long_description' => 'required',
            'city_image' => 'required',
        );

        $validator = \Validator::make($data,$rule);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->messages());
        }

        $city = new City();
        $city->name = $inputs['name'];
        $city->sequence_id = $inputs['sequence_id'] ?? 100;
        $city->long_description = $inputs['long_description'];
        
        $city_slug = $inputs['name'];
        $city->city_slug = (str_replace(' ', '-', strtolower($city_slug))); 
        $city_image = $request->file('city_image');
        $city_image_name = $city_image->getClientOriginalName();
        $city_image_name = explode(".",$city_image_name);
        $city_image_new_name = "";
        
        if($city_image) {
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
            $city_image_new_name = $imageName;
        }

        $city->city_image = $city_image_new_name;
        $city->meta_title = $inputs['meta_title'];
        $city->meta_description = $inputs['meta_description'];
        $city->meta_keyword = $inputs['meta_keyword'];
        
        $city->save();

        \Session::flash('flash_message', trans('words.added'));
        return \Redirect::back();
    }

    public function edit($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $city = City::findOrFail($id);
        $action = 'saakin_edit';

        return view('admin-dashboard.city-guide.edit',compact('city','action'));
    }

    public function update(Request $request, $id)
    {
        $data =  \Request::except(array('_token')) ;
        $inputs = $request->all();
        $rule=array(
            'name' => 'required',
            'long_description' => 'required',
        );

        $validator = \Validator::make($data,$rule);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->messages());
        }

        $city = City::findOrFail($id);
        $city->name = $inputs['name'];
        $city->sequence_id = $inputs['sequence_id'];
        $city->long_description = $inputs['long_description'];

        $city_image = $request->file('city_image');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
            \File::delete(public_path() .'/upload/cities/'.$city->city_image);
            $city->city_image = $imageName;
        }

        $city->meta_title = $inputs['meta_title'];
        $city->meta_description = $inputs['meta_description'];
        $city->meta_keyword = $inputs['meta_keyword'];

        $city->save();
        \Session::flash('flash_message', trans('words.updated'));
        return \Redirect::back();
    }

    public function destroy($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $city = City::findOrFail($id);
        $city->delete();
        \File::delete(public_path() .'/upload/cities/'.$city->city_image);
        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();
    }


    public function listCityDetail()
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }

        $cityDetails = CityDetail::paginate(10);
        $action = 'saakin_index';

        return view('admin-dashboard.city-guide-detail.index',compact('cityDetails','action'));
    }

    public function createCityDetail()    {

        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }
        $cities = City::all();
        $action = 'saakin_create';

        return view('admin-dashboard.city-guide-detail.create', compact('cities','action'));
    }

    public function storeCityDetail(Request $request)
    {
        dd('aa');   
        $data =  \Request::except(array('_token')) ;
        $inputs = $request->all();
        $rule=array(
            'city' => 'required',
        );

        $validator = \Validator::make($data,$rule);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->messages());
        }

        $cityDetail = new CityDetail();
        $cityDetail->city_id = $inputs['city'];
        $cityDetail->property_trends = $inputs['property_trends'];
        $cityDetail->neighborhood = $inputs['neighborhood'];
        $cityDetail->lifestyle = $inputs['lifestyle'];
        $cityDetail->things_to_consider = $inputs['things_to_consider'];
        $cityDetail->locations = $inputs['locations'];
        $cityDetail->attributes = $inputs['attributes'];
    

        $cityDetail->save();

        \Session::flash('flash_message', trans('words.added'));
        return \Redirect::back();
    }

    public function editCityDetail($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $cities = City::all();
        $cityDetail = CityDetail::findOrFail($id);
        $action = 'saakin_edit';

        return view('admin-dashboard.city-guide-detail.edit',compact('cities','cityDetail','action'));
    }

    public function updateCityDetail(Request $request, $id)
    {
        $data =  \Request::except(array('_token')) ;
        $inputs = $request->all();
        $rule=array(
            'city' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator->messages());
        }

        $cityDetail = CityDetail::findOrFail($id);
        $cityDetail->city_id = $inputs['city'];
        $cityDetail->property_trends = $inputs['property_trends'];
        $cityDetail->neighborhood = $inputs['neighborhood'];
        $cityDetail->lifestyle = $inputs['lifestyle'];
        $cityDetail->things_to_consider = $inputs['things_to_consider'];
        $cityDetail->locations = $inputs['locations'];
        $cityDetail->attributes = $inputs['attributes'];

        $cityDetail->save();
        
        \Session::flash('flash_message', trans('words.updated'));
        return \Redirect::back();
    }

    public function destroyCityDetail($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $cityDetail = CityDetail::findOrFail($id);

        $cityDetail->delete();

        \File::delete(public_path() .'/upload/cities/'.$cityDetail->image1);
        \File::delete(public_path() .'/upload/cities/'.$cityDetail->image2);
        \File::delete(public_path() .'/upload/cities/'.$cityDetail->image3);
        \File::delete(public_path() .'/upload/cities/'.$cityDetail->image4);
        \File::delete(public_path() .'/upload/cities/'.$cityDetail->image5);
        \File::delete(public_path() .'/upload/cities/'.$cityDetail->image6);

        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();
    }

}
