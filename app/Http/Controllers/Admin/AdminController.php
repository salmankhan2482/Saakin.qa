<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Agency;
use App\Properties;
use App\Http\Requests;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class AdminController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');

    }
    public function index()
    {
        return view('admin.pages.dashboard');
    }
	public function profile()
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }
        $data['agency'] = Agency::where("id",Auth::User()->agency_id)->first();
        $data['user'] = auth()->user();
        $action = 'app_profile';

        return view('admin-dashboard.profile.show',compact('data','action'));
    }

    public function updateProfile(Request $request)
    {      
    	$user = User::findOrFail(Auth::user()->id);
	    $data =  \Request::except(array('_token')) ;
        
        if(request('email') != $user->email)
        {
            $rule = array(
		        'name' => 'required',
		        'email' => 'required|email|max:75|unique:users,email'
            );
        }elseif(request('password') != '' ){
            $rule = array(
                'name' => 'required',
                'password' => 'required|min:3|confirmed'
            );
        }else{   
            $rule = array(
                'name' => 'required'
            );
        }
	   	$validator = \Validator::make($data,$rule);
        
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

	    $inputs = $request->all();
		$user->name = $inputs['name'];
		$user->email = $inputs['email'];
		$user->phone = $inputs['phone'];
        $user->whatsapp = $inputs['whatsapp'];

        if($request->hasFile('user_icon')) {
            $image = $request->file('user_icon'); 
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('upload/agencies/');
            
            if (File::exists(public_path('upload/agencies/'.$user->image_icon))) {
                File::delete(public_path('upload/agencies/'.$user->image_icon));
            }
            
            $image->move($destinationPath, $imagename);
            $user->image_icon = $imagename;
        }

        $user->about = $inputs['about'];
        $user->password = bcrypt(request('password'));
		$user->facebook = $inputs['facebook'];
		$user->twitter = $inputs['twitter'];
		$user->instagram = $inputs['instagram'];
		$user->linkedin = $inputs['linkedin'];
	    $user->save();

        //Agency Update
        if(Auth::User()->usertype=="Agency")
        {
            $agency = Agency::findOrFail($user->agency_id);
            $agency->name = $inputs['name'];
            $agency->email = $inputs['email'];
            $agency->phone = $inputs['phone'];
            $agency->whatsapp = $inputs['whatsapp'];
            $agency->agency_detail = $inputs['about'];
            if($request->hasFile('user_icon')) {
                $agency->image = $user->image_icon;
            }

            $agency->save();
        }

	    Session::flash('flash_message', trans('words.successfully_updated'));
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {

    		//$user = User::findOrFail(Auth::user()->id);


		    $data =  \Request::except(array('_token')) ;
            $rule  =  array(
                    'password'       => 'required|confirmed',
                    'password_confirmation'       => 'required'
                ) ;

            $validator = \Validator::make($data,$rule);

            if ($validator->fails())
            {
                    return redirect()->back()->withErrors($validator->messages());
            }

	   		/* $val=$this->validate($request, [
                    'password' => 'required|confirmed',
            ]);  */

	    $credentials = $request->only('password', 'password_confirmation'
            );

        $user = \Auth::user();
        $user->password = bcrypt($credentials['password']);
        $user->save();

	    Session::flash('flash_message', trans('words.successfully_updated'));

        return redirect()->back();
    }


}
