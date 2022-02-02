<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AgenciesExport;
use App\Exports\PropertiesExport;
use App\Http\Controllers\Controller;
use App\Imports\AgenciesImport;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Agency;
use Illuminate\Support\Facades\Mail;
use App\User;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class AgencyController extends Controller
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

        $agencies = Agency::paginate(10);

        return view('admin.pages.agencies',compact('agencies'));
    }

    public function create()    {

        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        return view('admin.pages.add_agency');
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
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'            
        );
        $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {   return redirect()->back()->withErrors($validator->messages());  }
        
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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'agency_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('upload/agencies/');
            $image->move($destinationPath, $imageName);
            $agency->image = $imageName;
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
            $user->confirmation_code = rand(1000,5000);
            $user->created_at = date("Y-m-d H:i:s");
            $user->updated_at = date("Y-m-d H:i:s");
            $user->save();

        \Session::flash('flash_message', trans('words.added'));
        //Sending Email to Agency 
        $to_email = $inputs['email'];
        $inputs['password'] = $password;
        Mail::send('emails.newagency', $inputs, function ($message) use ($to_email) {
            $message->from('hello@saakin.com', 'Saakin Inc.');
            $message->subject('Account Created Successfully');
            $message->to($to_email);
        });
        return redirect('admin/agencies');
    }

    public function edit($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $agency = Agency::findOrFail($id);
        return view('admin.pages.edit_agency',compact('agency'));
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
                $agency_image = $request->file('image');
                if ($agency_image) {
                    $agency_image_name = $agency_image[0]->getClientOriginalName();
                    $agency_image_name = explode(".", $agency_image_name);
                    $tmpFilePath = public_path('upload/agencies/');
                    $imageName = $agency_image_name[0] . '_' . time() . '.' . $agency_image[0]->extension();
                    $agency_image[0]->move($tmpFilePath, $imageName);
                    $agency->image = $imageName;
                }
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
