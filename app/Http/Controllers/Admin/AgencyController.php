<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use App\Agency;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Exports\AgenciesExport;
use App\Imports\AgenciesImport;
use App\Mail\AgencyRegisterMail;
use App\Exports\PropertiesExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class AgencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $action = 'saakin_index';
        if(Auth::User()->usertype!="Admin"){
            Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }

        $data['agencies'] = Agency::paginate(10);
        return view('admin-dashboard.agency.index',compact('data','action'));
    }

    public function create()
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }
        $action = 'saakin_create';
        return view('admin-dashboard.agency.create',compact('action'));
    }

    public function store(Request $request)
    {
        $data =  \Request::except(array('_token')) ;
        $inputs = $request->all();
        $rule=array(
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|max:200|unique:users,email',
            'password' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'            
        );
        $validator = \Validator::make($data,$rule);
        if ($validator->fails()){   
            return redirect()->back()->withErrors($validator->messages());  
        }
        $agency = new Agency();
        $agency->name = $inputs['name'];
        $agency->phone = $inputs['phone'];
        $agency->whatsapp = $inputs['whatsapp'];
        $agency->email = $inputs['email'];
        $agency->group_code = $inputs['group_code'];
        $agency->access_code = $inputs['access_code'];
        $agency->head_office = $inputs['head_office'];
        $agency->agency_detail = $inputs['detail'];
        $agency->meta_title = $inputs['meta_title'];
        $agency->meta_description = $inputs['meta_description'];
        $agency->meta_keyword = $inputs['meta_keyword'];

        if($request->hasFile('image')) {
            $image = $request->file('image'); 
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('upload/agencies/');

            if (File::exists(public_path('upload/agencies/'.$agency->image))) {
                File::delete(public_path('upload/agencies/'.$agency->image));
            }
            
            $image->move($destinationPath, $imagename);
            $agency->image = $imagename;
        }

        $agency->save();
        $agencyid = $agency->id;
        $password = $inputs['password'];
            //Adding Agency Into User
        $user = new User();
        $user->agency_id = $agencyid;
        $user->usertype = 'Agency';
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        $user->password = bcrypt($password);
        $user->phone = $inputs['phone'];
        $user->whatsapp = $inputs['whatsapp'];
        $user->status = 1;
        $user->image_icon = $imagename;
        $user->confirmation_code = rand(1000,5000);
        $user->created_at = date("Y-m-d H:i:s");
        $user->updated_at = date("Y-m-d H:i:s");
        $user->save();

        \Session::flash('flash_message', trans('words.added'));
        
        //Sending Email to Agency 
        $to_email = $inputs['email'];
        $inputs['password'] = $password;

        Mail::to($to_email)->send(new AgencyRegisterMail($inputs));
        return redirect('admin/agencies');
    }

    public function edit($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $action = 'saakin_index';
        $data['agency'] = Agency::findOrFail($id);
        return view('admin-dashboard.agency.edit',compact('data','action'));
    }

    public function update(Request $request, $id)
    {

        $data =  \Request::except(array('_token')) ;
        $inputs = $request->all();
        $email = $inputs['email'];
        $oldemail = $inputs['oldemail'];

        if($email!=$oldemail)
        {
            $rule = array('name'=>'required','email' => 'required|email|max:200|unique:users,email',);
        }
        else
        {
            $rule = array('name' => 'required');
        }

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $agency = Agency::findOrFail($id);
        $agency->name = $inputs['name'];
        $agency->phone = $inputs['phone'];
        $agency->whatsapp = $inputs['whatsapp'];
        $agency->access_code = $inputs['access_code'];
        $agency->group_code = $inputs['group_code'];
        $agency->email = $inputs['email'];
        $agency->head_office = $inputs['head_office'];
        $agency->agency_detail = $inputs['detail'];
        $agency->meta_title = $inputs['meta_title'];
        $agency->meta_description = $inputs['meta_description'];
        $agency->meta_keyword = $inputs['meta_keyword'];

            if($request->hasFile('image')) {
                $image = $request->file('image'); 
                $imagename = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('upload/agencies/');
    
                if (File::exists(public_path('upload/agencies/'.$agency->image))) {
                    File::delete(public_path('upload/agencies/'.$agency->image));
                }
                
                $image->move($destinationPath, $imagename);
                $agency->image = $imagename;
            }


        $agency->save();
        $user = User::where("agency_id",$agency->id)->where('usertype','Agency')->first();
        $password = $inputs['password'];
        if(!empty($inputs['password']))
        {
            $user->password = bcrypt($password);
        }
            $user->email = $inputs['email'];
            $user->phone = $inputs['phone'];
            $user->image_icon = $agency->image;
            $user->whatsapp = $inputs['whatsapp'];
            $user->save();


        \Session::flash('flash_message', trans('words.updated'));
        return redirect('admin/agencies');
    }

    public function destroy($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $agency = Agency::findOrFail($id);
        $agency->delete();

        $user = User::where("agency_id",$id)->delete();

        \File::delete(public_path() .'/upload/agencies/'.$agency->image);

        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();
    }

    public function agencies_export()
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');

        }


        return Excel::download(new AgenciesExport(), 'agencies.xlsx');

    }
    public function agencies_import()
    {
        if(Auth::User()->usertype!="Admin" && Auth::User()->usertype!="Agency"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');

        }

        Excel::import(new AgenciesImport(),request()->file('file'));

        return redirect()->back();

    }

    public function goMasterimport(){
        $id = \request()->id;
        $agency = Agency::find($id);
        $view =  view('admin.pages.import_agencies', compact('agency'))->render();
        return response()->json(['status' =>'success','html'=>$view]);
    }
}
