<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Properties;
use App\PropertyGallery;
use App\Agency;
use App\Enquire;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

use App\Exports\UsersExport;
use App\Roles;
use Maatwebsite\Excel\Facades\Excel;

class UsersController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		 parent::__construct();

    }

    public function index()   
     {

        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $action = 'saakin_index';
        if(isset($_GET['keyword']))
        {

            $type=$_GET['type'];
            $keyword=$_GET['keyword'];

            if(Auth::User()->usertype=="Agency"){
                $allusers = User::where('agency_id',Auth::User()->agency_id)->SearchUserByKeyword($keyword,$type)->paginate(25);
            } else {
                $allusers = User::SearchUserByKeyword($keyword,$type)->paginate(25);
            }

            $allusers->appends($_GET)->links();
        }
        else
        {
            if(Auth::User()->usertype=="Agency"){
                $allusers = User::where('usertype','Agents')->where('agency_id',Auth::User()->agency_id)->orderBy('id','desc')->paginate(25);

            }else {
                $allusers = User::where('usertype', '!=', 'Admin')->orderBy('id', 'desc')->paginate(25);
            }
        }

        return view('admin.pages.users',compact('allusers'));

    }

    public function create()    
    {
        // $titles= Properties::where('agency_id',36)->pluck('property_name');
        // dd($titles);


        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');

        }
        $action = 'saakin_create';
        $agencies = Agency::all();
        $roles = Roles::all();
        return view('admin-dashboard.user-management.users.create', compact(['agencies','roles','action']));
    }

    public function store(Request $request)
    {
    	$data =  \Request::except(array('_token')) ;

	    $inputs = $request->all();

	    if($inputs['usertype']=="Agents") {
            $rule=array(
                'name' => 'required',
                'phone' => 'required|unique:users',
                'whatsapp' => 'required|unique:users',
                'email' => 'required|email|max:75|unique:users,id',
                'password' => 'min:4|max:15',
                'image_icon' => 'required|mimes:jpg,jpeg,gif,png',
                'agency_id' => 'required'
            );
        } else {
            $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:75|unique:users,id',
                'password' => 'min:4|max:15',
                'image_icon' => 'mimes:jpg,jpeg,gif,png',
            );
        }

	   	 $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $isAlreadyExist = User::checkUserExists($inputs['email']);
        if($isAlreadyExist) {
            \Session::flash('flash_error_message', 'This email already exists. Try again');
            return \Redirect::back();
        }

        $user = new User;

		//User image
		$user_image = $request->file('image_icon');
        if($user_image) {
            $user_image_name = $user_image->getClientOriginalName();
            $user_image_name = explode(".",$user_image_name);
            $tmpFilePath = public_path('upload/members/');
            $imageName = $user_image_name[0].'_'.time().'.'.$user_image->extension();
            $user_image->move($tmpFilePath, $imageName);
            $user_image_new_name = $imageName;
            $user->image_icon = $user_image_new_name;
        }


		$user->usertype = $inputs['usertype'];
        if($inputs['usertype'] == "Agents") {
            $user->agency_id = $inputs['agency_id'];
        }
		$user->name = $inputs['name'];
		$user->email = $inputs['email'];
		$user->phone = $inputs['phone'];
  		$user->about = $inputs['about'];
        $user->whatsapp = $inputs['whatsapp'];
		$user->facebook = $inputs['facebook'];
		$user->twitter = $inputs['twitter'];
		$user->instagram = $inputs['instagram'];
		$user->linkedin = $inputs['linkedin'];
        $user->status = $inputs['status'];
		$user->password= bcrypt($inputs['password']);
	    
        if($user->save())
        {
            $user->roles()->attach($request->roles); 
        }
        //Sending Emails        
        $userEmail = $inputs["email"];
        if($inputs['usertype'] == "Agents") 
        {
            if(Auth::User()->usertype=='Admin')
            {
                $agency = Agency::findOrFail($inputs['agency_id']);
                $agencyName = $agency->name;
                $inputs['agency_'] = $agencyName;
                $email = $agency->email;                                
                Mail::send('emails.agencyagent', $inputs, function ($message) use ($email, $agencyName) {
                    $message->from('hello@saakin.com', 'Saakin Inc.');
                    $message->subject('New Agent has been created');
                    $message->to($email);
                });
            }
            else
            {
                $agencyName = Auth::user()->agency->name;
                $inputs['agency_'] = $agencyName;
            }
            Mail::send('emails.agent', $inputs, function ($message) use ($userEmail, $agencyName) {
                $message->from('hello@saakin.com', 'Saakin Inc.');
                $message->subject('Your agent account has been created');
                $message->to($userEmail);
                
            });
        }


        \Session::flash('flash_message', trans('words.added'));
        return \Redirect::back();
    }

    public function editUser($id)
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $agencies = Agency::all();
        $decrypted_id = Crypt::decryptString($id);
        $user = User::findOrFail($decrypted_id);
        $roles = Roles::all();

        return view('admin.pages.edit_user',compact('user','agencies', 'roles'));
    }

    public function updateUser(Request $request, $id)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        if($inputs['usertype']=="Agents") {
            $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:75|unique:users,id',
                'agency_id' => 'required'
            );
        } else {
            $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:75|unique:users,id',
            );
        }

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $user = User::findOrFail($id);

        if($inputs['email'] != $user->email) {
            $isAlreadyExist = User::checkUserExists($inputs['email']);
            if($isAlreadyExist) {
                \Session::flash('flash_error_message', 'This email already exists. Try again');
                return \Redirect::back();
            }
        }

        //User image
        $user_image = $request->file('image_icon');
        if($user_image) {
            $user_image_name = $user_image->getClientOriginalName();
            $user_image_name = explode(".",$user_image_name);
            $tmpFilePath = public_path('upload/members/');
            $imageName = $user_image_name[0].'_'.time().'.'.$user_image->extension();
            $user_image->move($tmpFilePath, $imageName);
            \File::delete(public_path() .'/upload/members/'.$user->image_icon);
            $user->image_icon = $imageName;
        }

        $user->usertype = $inputs['usertype'];
        if($inputs['usertype'] == "Agents") {
            $user->agency_id = $inputs['agency_id'];
        }
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->phone = $inputs['phone'];
        $user->about = $inputs['about'];
        $user->facebook = $inputs['facebook'];
        $user->twitter = $inputs['twitter'];
        $user->instagram = $inputs['instagram'];
        $user->linkedin = $inputs['linkedin'];
        $user->status = $inputs['status'];

        if($inputs['password'])
        {
            $user->password= bcrypt($inputs['password']);
        }

        if($user->save()){
            $user->roles()->sync($request->roles);
        }

        \Session::flash('flash_message', trans('words.successfully_updated'));
        return \Redirect::back();
    }

    public function view_user($id)
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $agencies = Agency::all();

        $decrypted_id = Crypt::decryptString($id);
        $user = User::findOrFail($decrypted_id);
        
        return view('admin.pages.view_user', compact('user','agencies'));
    }
    
    public function delete($id)
    {
    	if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $decrypted_id = Crypt::decryptString($id);

        if($decrypted_id!=1)
        {
            /*$property_list = Properties::where('user_id',$decrypted_id)->get();

            foreach ($property_list as $property_data)
            {
                $property_gallery_images = PropertyGallery::where('property_id',$property_data->id)->get();

                foreach ($property_gallery_images as $gallery_images) {

                    \File::delete(public_path() .'/upload/gallery/'.$gallery_images->image_name);

                    $property_gallery_obj = PropertyGallery::findOrFail($gallery_images->id);
                    $property_gallery_obj->delete();
                }

                $property = Properties::findOrFail($property_data->id);

                \File::delete(public_path() .'/upload/properties/'.$property->featured_image);

                \File::delete(public_path() .'/upload/floorplan/'.$property->floor_plan);

                $property->delete();
            }*/

            $user = User::findOrFail($decrypted_id);

            \File::delete(public_path() .'/upload/members/'.$user->image_icon);

            if($user->delete())
            {
                $user->roles()->detach();
            } 
        }
        else
        {
            \Session::flash('flash_message', trans('words.access_denied'));
             return redirect()->back();
        }

        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();
    }

    public function user_export()
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }
         return Excel::download(new UsersExport, 'users.xlsx');
    }

}
