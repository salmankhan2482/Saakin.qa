<?php

namespace App\Http\Controllers\Admin;

use App\Enquire;
use App\PropertyCities;
use App\CompanyRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyRegistrationMail;
use Illuminate\Support\Facades\Session;

class CompanyRegistrationController extends MainAdminController
{

    public function index()
    {
        $registrations = CompanyRegistration::paginate(10);
        $action = 'saakin_index';
        return view('admin-dashboard.inquiries.company_registration.index', compact('registrations', 'action'));
    }

    public function create()
    {
        
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'company_name' => 'required',
            'city' => 'required',
            'job_title' => 'required',
            'email' => 'required|email|unique:company_registrations,email',
            'g-recaptcha-response' => 'required|captcha',
         ]);
        
        $cr = new CompanyRegistration();
        $cr->first_name = request('first_name');
        $cr->last_name = request('last_name');
        $cr->email = request('email');
        $cr->phone = request('phone');
        $cr->company_name = request('company_name');
        $cr->city = request('city');
        $cr->job_title = request('job_title');
        $cr->email = request('email');
        $cr->save();

        $enquire = new Enquire();
        $enquire->name = request('company_name');
        $enquire->email = $request->email;
        $enquire->company_registrations_id = $cr->id;
        $enquire->phone = $request->phone;
        $enquire->subject = 'Request For Company Registration';
        $enquire->type = 'Company Registration Inquiry';
        $enquire->save();

        $data['request'] = request();
        $data['city_name'] = PropertyCities::where('id', Request('city'))->value('name');
        Mail::to('hello@saakin.qa')->send(new CompanyRegistrationMail($data));

        return redirect()->back()->with('flash_message_contact', 'Request for company registration has been sent.');
    }
    
    public function show($id)
    {
        
        $registration = CompanyRegistration::find($id);
        // $inquire = Enquire::where('company_registrations_id', $registration->id)->first();
        // $inquire->enquire_id =1;
        // $inquire->update();
        DB::table('enquire')
            ->where('company_registrations_id', $registration->id)
            ->update(['enquire_id' => 1]);
            
        $action = 'saakin_index';
        return view('admin-dashboard.inquiries.company_registration.show', compact('registration','action'));

    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $registration = CompanyRegistration::find($id);
        $inquire = Enquire::where('company_registrations_id', $registration->id)->first();
        $registration->delete();
        $inquire->delete();
        Session::flash('flash_message', trans('words.deleted'));
        return redirect()->back();
    }

}
