<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use Auth;
use App\City;
use App\CityDetail;
use Session;

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
            'short_description' => 'required',
            'long_description' => 'required',
            'city_image' => 'required',
            'attributes' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $city = new City();
        $city->name = $inputs['name'];
        $city->short_description = $inputs['short_description'];
        $city->long_description = $inputs['long_description'];
        $city->attributes = $inputs['attributes'];
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
            'short_description' => 'required',
            'long_description' => 'required',
            'attributes' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $city = City::findOrFail($id);
        $city->name = $inputs['name'];
        $city->short_description = $inputs['short_description'];
        $city->long_description = $inputs['long_description'];
        $city->attributes = $inputs['attributes'];

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

        return view('admin.pages.city_details',compact('cityDetails'));
    }

    public function createCityDetail()    {

        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }
        $cities = City::all();

        return view('admin.pages.add_city_detail', compact('cities'));
    }

    public function storeCityDetail(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'city' => 'required',
            'name' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'city_image1' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $cityDetail = new CityDetail();
        $cityDetail->city_id = $inputs['city'];
        $cityDetail->title = $inputs['name'];
        $cityDetail->short_description = $inputs['short_description'];
        $cityDetail->long_description = $inputs['long_description'];
        $cityDetail->property_trends = $inputs['property_trends'];
        $cityDetail->neighborhood = $inputs['neighborhood'];
        $cityDetail->lifestyle = $inputs['lifestyle'];
        $cityDetail->things_to_consider = $inputs['things_to_consider'];
        $cityDetail->locations = $inputs['locations'];
        $cityDetail->attributes = $inputs['attributes'];
        

        $city_image = $request->file('city_image1');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
            $city_image_new_name1 = $imageName;
            $cityDetail->image1 = $city_image_new_name1;
        }

        $city_image = $request->file('city_image2');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
            $city_image_new_name2 = $imageName;
            $cityDetail->image2 = $city_image_new_name2;
        }

        $city_image = $request->file('city_image3');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
            $city_image_new_name3 = $imageName;
            $cityDetail->image3 = $city_image_new_name3;
        }

        $city_image = $request->file('city_image4');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
            $city_image_new_name4 = $imageName;
            $cityDetail->image4 = $city_image_new_name4;
        }

        $city_image = $request->file('city_image5');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
            $city_image_new_name5 = $imageName;
            $cityDetail->image5 = $city_image_new_name5;
        }

        $city_image = $request->file('city_image6');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
            $city_image_new_name6 = $imageName;
            $cityDetail->image6 = $city_image_new_name6;
        }

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
        return view('admin.pages.edit_city_detail',compact('cities','cityDetail'));
    }

    public function updateCityDetail(Request $request, $id)
    {

        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'city' => 'required',
            'name' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $cityDetail = CityDetail::findOrFail($id);
        $cityDetail->city_id = $inputs['city'];
        $cityDetail->title = $inputs['name'];
        $cityDetail->short_description = $inputs['short_description'];
        $cityDetail->long_description = $inputs['long_description'];
        $cityDetail->property_trends = $inputs['property_trends'];
        $cityDetail->neighborhood = $inputs['neighborhood'];
        $cityDetail->lifestyle = $inputs['lifestyle'];
        $cityDetail->things_to_consider = $inputs['things_to_consider'];
        $cityDetail->locations = $inputs['locations'];
        $cityDetail->attributes = $inputs['attributes'];

        $city_image = $request->file('city_image1');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
//            \File::delete(public_path() .'/upload/cities/'.$cityDetail->image1);
            $cityDetail->image1 = $imageName;
        }

        $city_image = $request->file('city_image2');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
//            \File::delete(public_path() .'/upload/cities/'.$cityDetail->image2);
            $cityDetail->image2 = $imageName;
        }

        $city_image = $request->file('city_image3');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
//            \File::delete(public_path() .'/upload/cities/'.$cityDetail->image3);
            $cityDetail->image3 = $imageName;
        }

        $city_image = $request->file('city_image4');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
//            \File::delete(public_path() .'/upload/cities/'.$cityDetail->image4);
            $cityDetail->image4 = $imageName;
        }

        $city_image = $request->file('city_image5');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
//            \File::delete(public_path() .'/upload/cities/'.$cityDetail->image5);
            $cityDetail->image5 = $imageName;
        }

        $city_image = $request->file('city_image6');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
//            \File::delete(public_path() .'/upload/cities/'.$cityDetail->image6);
            $cityDetail->image6 = $imageName;
        }


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
