<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use App\User;
use App\Agency;
use App\Properties;
use App\Http\Requests;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
        $agency = Agency::where("id",Auth::User()->agency_id)->first();
        return view('admin.pages.profile',['agency'=>$agency]);
    }

    public function updateProfile(Request $request)
    {
        
    	$user = User::findOrFail(Auth::user()->id);
	    $data =  \Request::except(array('_token')) ;
        $oldemail = $request->oldemail;
        if($oldemail!=$request->email)
        {
            $rule = array(
		        'name' => 'required',
		        'email' => 'required|email|max:75|unique:users,email');
        }
        else
        {   $rule = array(
            'name' => 'required');
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
                $image_icon = $request->file('user_icon');
                if ($image_icon) {
                    $image_icon_name = $image_icon->getClientOriginalName();
                    $image_icon_name = explode(".", $image_icon_name);
                    $tmpFilePath = public_path('upload/agencies/');
                    $imageName = time() . '.' . $image_icon->extension();
                    $image_icon->move($tmpFilePath, $imageName);
                    $user->image_icon = $imageName;
                }
            }
  		$user->about = $inputs['about'];
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
                $agency_image = $request->file('user_icon');
                if ($agency_image) {
                    $agency_image_name = $agency_image->getClientOriginalName();
                    $agency_image_name = explode(".", $agency_image_name);
                    $tmpFilePath = public_path('upload/agencies/');
                    $imageName = 'agency_'. '_' . time() . '.' . $agency_image->extension();
                    $agency_image->move($tmpFilePath, $imageName);
                    $agency->image = $imageName;
                }
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
