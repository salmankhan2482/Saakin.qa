<?php

namespace App\Http\Controllers\Admin;

use Hash;
use Session;
use App\User;
use App\Agency;
use App\Enquire;
use Carbon\Carbon;
use App\Properties;
use App\Http\Requests;
use App\PropertyGallery;
use Illuminate\Support\Str;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;

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

        $allusers = User::when(Auth::User()->usertype == "Agency", function($query){
            $query->where('usertype','Agents')->where('agency_id',Auth::User()->agency_id);
        })
        ->when(request('keyword'), function($query){
            $query->where("name", 'like', '%' .request('keyword'). '%')
            ->orWhere("email", 'like', '%' .request('keyword'). '%');
        })
        ->when(request('type'), function($query){
            $query->where("usertype", request('type'));
        })
        ->when(Auth::User()->usertype == "Admin", function($query){
            $query->where('usertype', '!=', 'Admin');
        })
        ->orderBy('id','desc')->paginate(25);
        $action = 'saakin_index';
        
        $action = 'saakin_index';
        return view('admin-dashboard.user-management.users.index',compact('allusers', 'action'));

    }

    public function create()    
    {

        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $action = 'saakin_create';
        $agencies = Agency::all();
        $roles = Role::pluck('name','name')->all();
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
  		// $user->about = $inputs['about'];
        $user->whatsapp = $inputs['whatsapp'];
		// $user->facebook = $inputs['facebook'];
		// $user->twitter = $inputs['twitter'];
		// $user->instagram = $inputs['instagram'];
		// $user->linkedin = $inputs['linkedin'];
        $user->status = $inputs['status'];
		$user->password= bcrypt($inputs['password']);
	    
        if($user->save())
        {
            $user->assignRole($request->input('roles'));
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
                $message->from('hello@saakin.qa', 'Saakin Qatar.');
                $message->subject('Your agent account has been created');
                $message->to($userEmail);
                
            });
        }


        \Session::flash('flash_message', trans('words.added'));
        return \Redirect::back();
    }

    public function edit($id)
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $agencies = Agency::all();
        $decrypted_id = Crypt::decryptString($id);
        $user = User::findOrFail($decrypted_id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $action = 'saakin_create';

        return view('admin-dashboard.user-management.users.edit',compact('user','agencies', 'roles', 'userRole','action'));
    }

    public function update(Request $request, $id)
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
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));
        }

        \Session::flash('flash_message', trans('words.successfully_updated'));
        return \Redirect::back();
    }

    public function show($id)
    {   
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $agencies = Agency::all();

        $decrypted_id = Crypt::decryptString($id);
        $user = User::findOrFail($decrypted_id);
        $action = 'saakin_index';
        
        return view('admin-dashboard.user-management.users.show', compact('user','agencies', 'action'));
    }
    
    public function destroy($id)
    {
    	if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $decrypted_id = Crypt::decryptString($id);

        if($decrypted_id!=1)
        {
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
