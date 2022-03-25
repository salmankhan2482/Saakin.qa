<?php

namespace App\Http\Controllers;

use Auth;
use App\Blog;
use App\City;
use App\User;
use messages;
use App\Types;
use App\Agency;
use App\Enquire;
use App\Partners;
use App\CityGuide;
use App\Properties;
use App\Subscriber;
use App\BlogCategory;
use App\Testimonials;
use App\PropertyAreas;
use App\PropertyTowns;
use App\PropertyCities;
use App\PropertyAmenity;
use App\PropertyPurpose;
use App\PropertySubCities;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\Contact_Inquiry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Mail\Register_Mail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class IndexController extends Controller
{
    public function __construct()
    {
    }


    public function index()
    {
        if (!$this->alreadyInstalled()) {
            return redirect('public/install');
        }

        $propertyTypes = Types::all();
        $cities = Properties::select('address')->distinct()->groupBy('address')->get();

        $propertyPurposes = PropertyPurpose::all();
        $agents = User::where('usertype', 'Agency')->get();
        $amenities = PropertyAmenity::all()->sortBy('name');

        $featured_properties = Properties::where('status', '1')->where('featured_property', '1')->inRandomOrder()->take(6)->get();
        $partners = Partners::orderBy('id', 'desc')->get();
        $cityGuides = City::where('status', '1')->orderBy('id', 'asc')->take(4)->get();

        return view('front-view.pages.index', compact('featured_properties', 'partners', 'cityGuides', 'cities', 'propertyTypes', 'propertyPurposes', 'agents', 'amenities'));
    }
    public function livesearch(Request $request)
    {

        $term = $request->get('keyword');
        $data = Properties::select("property_name as name", "featured_image as img", "address as address", "property_slug as slug", "id as id")->where("property_name", "LIKE", "%{$request->input('keyword')}%")->where("property_purpose", "LIKE", "%{$request->input('keyword')}%")->where("address", "LIKE", "%{$request->input('keyword')}%")->get();

        return $data;
    }

    public function selectBuyRentForSearch($purpose)
    {
        if (request()->ajax()) {
            $featured_properties = Properties::where('status', '1')
                ->where('featured_property', '1')
                ->inRandomOrder()->take(6)
                ->where('property_purpose', $purpose)
                ->get();
            return view('front-view.pages.include.featured_properties', compact('featured_properties'))->render();
        }
    }

    public function searchMeDesktop(Request $request)
    {
        if ($request->ajax()) {
            $purpose = $request->purpose;
            if ($request->country != 'Stop') {

                $cities = DB::table('property_cities')
                    ->leftJoin('properties', 'property_cities.id', 'properties.city')
                    ->select('property_cities.*')
                    ->where('properties.status', 1)
                    ->where('property_cities.name', 'like', '%' . $request->country . '%')
                    ->when(request()->purpose, function ($query) {
                        $query->where('property_purpose', request()->purpose);
                    })->when(request()->type, function ($query) {
                        $query->where('property_type', request()->type);
                    })
                    ->orderBy('property_cities.name', 'ASC')
                    ->distinct()->get();

                $subcities = DB::table('property_sub_cities')
                    ->leftJoin('properties', 'property_sub_cities.id', 'properties.subcity')
                    ->leftJoin('property_cities', 'property_sub_cities.property_cities_id', 'property_cities.id')
                    ->select('property_sub_cities.*', 'property_cities.name as city_name', 'property_cities.id as city_id')
                    ->where('properties.status', 1)
                    ->where('property_sub_cities.name', 'like', '%' . $request->country . '%')
                    ->when(request()->purpose, function ($query) {
                        $query->where('property_purpose', request()->purpose);
                    })->when(request()->type, function ($query) {
                        $query->where('property_type', request()->type);
                    })
                    ->orderBy('property_sub_cities.name', 'ASC')
                    ->distinct()->get();

                $towns = DB::table('property_towns')
                    ->leftJoin('properties', 'property_towns.id', 'properties.town')
                    ->leftJoin('property_cities', 'property_towns.property_cities_id', 'property_cities.id')
                    ->leftJoin('property_sub_cities', 'property_towns.property_sub_cities_id', 'property_sub_cities.id')
                    ->select('property_towns.*', 'property_cities.name as city_name', 'property_cities.id as city_id', 'property_sub_cities.name as sub_city_name', 'property_sub_cities.id as sub_city_id')
                    ->where('properties.status', 1)
                    ->where('property_towns.name', 'like', '%' . $request->country . '%')
                    ->when(request()->purpose, function ($query) {
                        $query->where('property_purpose', request()->purpose);
                    })->when(request()->type, function ($query) {
                        $query->where('property_type', request()->type);
                    })
                    ->orderBy('property_towns.name', 'ASC')
                    ->distinct()->get();


                $areas = DB::table('property_areas')
                    ->leftJoin('properties', 'property_areas.id', 'properties.area')
                    ->leftJoin('property_cities', 'property_areas.property_cities_id', 'property_cities.id')
                    ->leftJoin('property_sub_cities', 'property_areas.property_sub_cities_id', 'property_sub_cities.id')
                    ->leftJoin('property_towns', 'property_areas.property_towns_id', 'property_towns.id')
                    ->select('property_areas.*', 'property_cities.name as city_name', 'property_sub_cities.name as sub_city_name', 'property_towns.name as town_name', 'property_cities.id as city_id', 'property_sub_cities.id as sub_city_id', 'property_towns.id as town_id')
                    ->where('properties.status', 1)
                    ->where('property_areas.name', 'like', '%' . $request->country . '%')
                    ->when(request()->purpose, function ($query) {
                        $query->where('property_purpose', request()->purpose);
                    })->when(request()->type, function ($query) {
                        $query->where('property_type', request()->type);
                    })
                    ->orderBy('property_areas.name', 'ASC')
                    ->distinct()->get();

                $output = '';
                if (count($cities) > 0 || count($subcities) > 0 || count($towns) > 0 || count($areas) > 0) {
                    $output =
                        '<ul class="list-group desktop-search-li" >';
                    foreach ($cities as $i => $row) {
                        if ($i <= 10) {
                            $output .= '<li class="list-group-item live-search-li"><input type="hidden" id="city_id" name="city" value="' . $row->id . '" ><i class="fas fa-map-marker-alt" aria-hidden="true"></i> ' . $row->name . '</li>';
                        }
                    }
                    foreach ($subcities as $i => $row) {
                        if ($i <= 10) {
                            $output .=
                                '<li class="list-group-item live-search-li"> <input type="hidden" id="city_id" name="city" value="' . $row->city_id . '" ><input type="hidden" id="sub_city_id" name="subcity" value="' . $row->id . '" ><i class="fas fa-map-marker-alt" aria-hidden="true"></i> ' . $row->name . ' (' . $row->city_name . ') </li>';
                        }
                    }
                    foreach ($towns as $i => $row) {
                        if ($i <= 10) {
                            $output .= '<li class="list-group-item live-search-li"><input type="hidden" id="city_id" name="city" value="' . $row->city_id . '" ><input type="hidden" id="sub_city_id" name="subcity" value="' . $row->sub_city_id . '" ><input type="hidden" id="town_id" name="town" value="' . $row->id . '" ><i class="fas fa-map-marker-alt" aria-hidden="true"></i> ' . $row->name . ' (' . $row->city_name . ', ' . $row->sub_city_name . ') </li>';
                        }
                    }
                    foreach ($areas as $i => $row) {
                        if ($i <= 10) {
                            $output .= '<li class="list-group-item live-search-li"><i class="fas fa-map-marker-alt" aria-hidden="true"></i> ' . $row->name . ' (' . $row->city_name . ', ' . $row->sub_city_name . ', ' . $row->town_name . ')<input type="hidden" id="city_id" name="city" value="' . $row->city_id . '" ><input type="hidden" id="sub_city_id" name="subcity" value="' . $row->sub_city_id . '" ><input type="hidden" id="town_id" name="town" value="' . $row->town_id . '" ><input type="hidden" id="area_id" name="area" value="' . $row->id . '" ></li>';
                        }
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<li class="list-group-item live-search-li">' . 'No results' . '</li>';
                }
                return $output;
            }
        }
    }

    public function searchMeMobile(Request $request)
    {
        if ($request->ajax()) {
            if ($request->country != 'Stop') {

                $cities = DB::table('property_cities')
                    ->leftJoin('properties', 'property_cities.id', 'properties.city')
                    ->select('property_cities.*')
                    ->where('properties.status', 1)
                    ->where('property_cities.name', 'like', '%' . $request->country . '%')
                    ->when(request()->purpose, function ($query) {
                        $query->where('property_purpose', request()->purpose);
                    })->when(request()->type, function ($query) {
                        $query->where('property_type', request()->type);
                    })
                    ->orderBy('property_cities.name', 'ASC')
                    ->distinct()->get();

                $subcities = DB::table('property_sub_cities')
                    ->leftJoin('properties', 'property_sub_cities.id', 'properties.subcity')
                    ->leftJoin('property_cities', 'property_sub_cities.property_cities_id', 'property_cities.id')
                    ->select('property_sub_cities.*', 'property_cities.name as city_name', 'property_cities.id as city_id')
                    ->where('properties.status', 1)
                    ->where('property_sub_cities.name', 'like', '%' . $request->country . '%')
                    ->when(request()->purpose, function ($query) {
                        $query->where('property_purpose', request()->purpose);
                    })->when(request()->type, function ($query) {
                        $query->where('property_type', request()->type);
                    })
                    ->orderBy('property_sub_cities.name', 'ASC')
                    ->distinct()->get();

                $towns = DB::table('property_towns')
                    ->leftJoin('properties', 'property_towns.id', 'properties.town')
                    ->leftJoin('property_cities', 'property_towns.property_cities_id', 'property_cities.id')
                    ->leftJoin('property_sub_cities', 'property_towns.property_sub_cities_id', 'property_sub_cities.id')
                    ->select('property_towns.*', 'property_cities.name as city_name', 'property_cities.id as city_id', 'property_sub_cities.name as sub_city_name', 'property_sub_cities.id as sub_city_id')
                    ->where('properties.status', 1)
                    ->where('property_towns.name', 'like', '%' . $request->country . '%')
                    ->when(request()->purpose, function ($query) {
                        $query->where('property_purpose', request()->purpose);
                    })->when(request()->type, function ($query) {
                        $query->where('property_type', request()->type);
                    })
                    ->orderBy('property_towns.name', 'ASC')
                    ->distinct()->get();


                $areas = DB::table('property_areas')
                    ->leftJoin('properties', 'property_areas.id', 'properties.area')
                    ->leftJoin('property_cities', 'property_areas.property_cities_id', 'property_cities.id')
                    ->leftJoin('property_sub_cities', 'property_areas.property_sub_cities_id', 'property_sub_cities.id')
                    ->leftJoin('property_towns', 'property_areas.property_towns_id', 'property_towns.id')
                    ->select('property_areas.*', 'property_cities.name as city_name', 'property_sub_cities.name as sub_city_name', 'property_towns.name as town_name', 'property_cities.id as city_id', 'property_sub_cities.id as sub_city_id', 'property_towns.id as town_id')
                    ->where('properties.status', 1)
                    ->where('property_areas.name', 'like', '%' . $request->country . '%')
                    ->when(request()->purpose, function ($query) {
                        $query->where('property_purpose', request()->purpose);
                    })->when(request()->type, function ($query) {
                        $query->where('property_type', request()->type);
                    })
                    ->orderBy('property_areas.name', 'ASC')
                    ->distinct()->get();

                $output = '<ul class="list-group" 
                style="width: 75vw; margin-top: -10px; margin-left: -15px; display: block;  position: absolute;  z-index: 1; overflow: auto; max-height: 30vh;" >';
                if (count($cities) > 0 || count($subcities) > 0 || count($towns) > 0 || count($areas) > 0) {
                    foreach ($cities as $i => $row) {
                        if ($i <= 10) {
                            $output .= '<li class="list-group-item live-search-li"><input type="hidden" id="city_id" name="city" value="' . $row->id . '" ><i class="fas fa-map-marker-alt" aria-hidden="true"></i> ' . $row->name . '</li>';
                        }
                    }
                    foreach ($subcities as $i => $row) {
                        if ($i <= 10) {
                            $output .=
                                '<li class="list-group-item live-search-li"> <input type="hidden" id="city_id" name="city" value="' . $row->city_id . '" ><input type="hidden" id="sub_city_id" name="subcity" value="' . $row->id . '" ><i class="fas fa-map-marker-alt" aria-hidden="true"></i> ' . $row->name . ' (' . $row->city_name . ') </li>';
                        }
                    }
                    foreach ($towns as $i => $row) {
                        if ($i <= 10) {
                            $output .= '<li class="list-group-item live-search-li"><input type="hidden" id="city_id" name="city" value="' . $row->city_id . '" ><input type="hidden" id="sub_city_id" name="subcity" value="' . $row->sub_city_id . '" ><input type="hidden" id="town_id" name="town" value="' . $row->id . '" ><i class="fas fa-map-marker-alt" aria-hidden="true"></i> ' . $row->name . ' (' . $row->city_name . ', ' . $row->sub_city_name . ') </li>';
                        }
                    }
                    foreach ($areas as $i => $row) {
                        if ($i <= 10) {
                            $output .= '<li class="list-group-item live-search-li"><i class="fas fa-map-marker-alt" aria-hidden="true"></i> ' . $row->name . ' (' . $row->city_name . ', ' . $row->sub_city_name . ', ' . $row->town_name . ')<input type="hidden" id="city_id" name="city" value="' . $row->city_id . '" ><input type="hidden" id="sub_city_id" name="subcity" value="' . $row->sub_city_id . '" ><input type="hidden" id="town_id" name="town" value="' . $row->town_id . '" ><input type="hidden" id="area_id" name="area" value="' . $row->id . '" ></li>';
                        }
                    }
                    $output .= '</ul>';
                } else {
                    $output .= '<li class="list-group-item live-search-li mbl-search-li" style="width: 96%;  margin-left: -15px;">' . 'No results' . '</li>';
                }
                return $output;
            }
        }
    }

    public function testimonialslist()
    {
        $alltestimonials = Testimonials::orderBy('id', 'desc')->paginate(10);

        return view('pages.testimonials', compact('alltestimonials'));
    }

    public function alreadyInstalled()
    {
        return file_exists(base_path('/public/.lic'));
    }

    public function subscribe(Request $request)
    {
        $data =  \Request::except(array('_token'));
        $inputs = $request->all();
        $rule = array('email' => 'required|email|max:100|unique:subscriber,email');
        $validator = \Validator::make($data, $rule);
        if ($validator->fails()) {
            $response['statusCode'] = 100;
            $response['title'] = 'Subscription Unsuccessful';
            $response['text'] = 'You are already on BOARD';
            $response['icon'] = 'info';
            echo json_encode($response);
        } else {
            $subscriber = new Subscriber;
            $subscriber->email = $inputs['email'];
            $subscriber->ip = $_SERVER['REMOTE_ADDR'];
            $subscriber->save();
            $response['statusCode'] = 200;
            $response['title'] = 'Subscription Successful';
            $response['text'] = 'We are so HAPPY to HAVE you on BOARD';
            $response['icon'] = 'success';
            echo json_encode($response);
        }
    }

    public function aboutus_page()
    {
        return view('pages.about');
    }

    public function pricing_plan()
    {
        return view('pages.pricing_plan');
    }

    public function contact_us_page()
    {
        $whatsapp_number = '+97470125000';
        $whatsapp_text = 'I would like to inquire about the Rent/Sale properties in Qatar posted on saakin.qa';

        return view('front.pages.contact-us', compact('whatsapp_text', 'whatsapp_number'));
    }
    public function contact_us_sendemail(Request $request)
    {

        $data =  \Request::except(array('_token'));

        $inputs = $request->all();
        $rule = array(
            'name' => 'required',
            'email' => 'required|email',
            'your_message' => 'required',
            'g-recaptcha-response' => 'required|captcha'

        );

        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages())->withInput();
        }

        $enquire = new Enquire();
        $enquire->enquire_id = 2;
        $enquire->name = $request->name;
        $enquire->email = $request->email;
        $enquire->phone = $request->phone;
        $enquire->subject = $request->subject;
        $enquire->message = $request->your_message;
        $enquire->type = $request->type;
        $enquire->created_at = date("Y-m-d H:i:s");
        $enquire->updated_at = date("Y-m-d H:i:s");
        $enquire->save();


        $data_email['name'] = $inputs['name'];
        $data_email['email'] = $inputs['email'];
        $data_email['phone'] = $inputs['phone'];
        $data_email['subject'] = $inputs['subject'];
        $data_email['your_message'] = $inputs['your_message'];

        Mail::to('hello@saakin.qa')->send(new Contact_Inquiry($data_email));

        Session::flash('flash_message_contact', trans('words.thanks_for_contacting_us'));
        return Redirect::back();
    }


    /**
     * Do user login
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function login()
    {
        if (Auth::check()) {

            return redirect('dashboard');
        }

        return view('front.pages.auth.login');
    }


    public function postLogin(Request $request)
    {

        //echo bcrypt('123456');
        //exit;
        if (getcong('recaptcha') == 1) {

            $this->validate($request, [

                'email' => 'required|email', 'password' => 'required'
            ]);
        } else {

            $this->validate($request, [
                'email' => 'required|email', 'password' => 'required'
            ]);
        }

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->status == '0') {
                \Auth::logout();
                \Session::flash('login_error_flash_msg', 'Required');
                return redirect('/login')->withErrors(trans('words.account_not_activated_msg'));
            }
            return $this->handleUserWasAuthenticated($request);
        }

        \Session::flash('login_error_flash_msg', 'Required');
        return redirect('/login')->withErrors(trans('words.email_password_invalid'));
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect('/dashboard');
    }

    public function register()
    {
        if (Auth::check()) {

            return redirect('admin/dashboard');
        }

        return view('front.pages.auth.register');
    }

    public function postRegister(Request $request)
    {
        $data =  \Request::except(array('_token'));
        $inputs = $request->all();

        if (getcong('recaptcha') == 1) {
            $rule = array(
                'name' => 'required',
                'email' => 'required|email|max:75|unique:users',
                'password' => 'required|min:3|confirmed',
                'g-recaptcha-response' => 'required|captcha'
            );
        } else {
            $rule = array(
                'name' => 'required',
                'email' => 'required|email|max:75|unique:users',
                'password' => 'required|min:3|confirmed'
            );
        }

        $validator = \Validator::make($data, $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        $user = new User;
        $string = Str::random(15);
        $user_name = $inputs['name'];
        $user_email = $inputs['email'];
        $user->usertype = 'User';
        $user->name = $user_name;
        $user->email = $user_email;
        $user->password = bcrypt($inputs['password']);
        $user->confirmation_code = $string;
        $user->save();

        //Verify user
        $user_name = $inputs['name'];
        $data_email = array(
            'name' => $user_name,
            'confirmation_code' => $string
        );
        $subject = 'Welcome to' . getcong('site_name');

        if (getenv("MAIL_USERNAME")) {
            Mail::to($inputs['email'])->send(new Register_Mail($data_email));
            // \Mail::send('emails.verify', $data_email, function($message) use ($inputs){
            //     $message->to($inputs['email'], $inputs['name'])
            //     ->from(getenv("mail_from_address"))
            //     ->subject('Welcome to'.getcong('site_name'));
            // });

            // \Mail::send('emails.verify', $data_email, function($message) use ($inputs, $subject) {
            //     $message->to($inputs['email'], $inputs['name'])->subject($subject);
            // });
        }

        \Session::flash('flash_message', trans('words.verify_account_msg'));
        return \Redirect::back();
    }


    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        //return redirect('admin/');
        return redirect('/');
    }

    public function confirm($code)
    {

        $user = User::where('confirmation_code', $code)->first();
        $user->status = '1';
        $user->save();
        \Session::flash('flash_message', trans('words.confirmation_msg'));

        return redirect('login/');
        //return view('pages.login');
    }

    public function sitemap()
    {
        $site_url = \URL::to('/');

        $properties = Properties::where(['status' => '1'])->orderBy('id', 'desc')->get();
        $blogs = Blog::get();
        $blog_categories = BlogCategory::pluck('slug');
        $agencies = Agency::get();
        $city_guides = CityGuide::get();

        $salePropertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select('property_types.id', 'property_types.types', 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where('property_purpose', 'Sale')
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();

        $citiesForSecond = [];
        foreach ($salePropertyTypes as $salePropertyType) {
            $result = DB::table('property_cities')
                ->leftJoin('properties', 'property_cities.id', 'properties.city')
                ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
                ->where('property_purpose', 'Sale')
                ->where('property_type', $salePropertyType->id)
                ->groupBy('property_cities.name')
                ->orderBy("pcount", "DESC")
                ->get();

            if ($result->isEmpty()) {
            }
        }


        $rentPropertyTypes =  DB::table('property_types')
            ->join('properties', "property_types.id", "properties.property_type")
            ->select('property_types.id', 'property_types.types', 'property_types.*', DB::Raw('COUNT(properties.id) as pcount'))
            ->where("properties.status", 1)
            ->where('property_purpose', 'Rent')
            ->groupBy("property_types.id")
            ->orderBy("pcount", "desc")
            ->get();

        return response()->view('pages.sitemap', compact('site_url', 'properties', 'blogs', 'blog_categories', 'agencies', 'salePropertyTypes', 'rentPropertyTypes', 'city_guides'))->header('Content-Type', 'text/xml');
    }
}
