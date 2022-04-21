<?php

namespace App\Http\Controllers;

use App\Enquire;
use App\PropertyCities;
use App\CompanyRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyRegistrationMail;
use App\User;

class CompanyRegistrationController extends Controller
{
    public function index()
    {
        return view('front.pages.auth.company_registration');
    }
    public function post_registration(Request $request)
    {
         
        $validator = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'company_name' => 'required',
            'city' => 'required',
            'job_title' => 'required',
            'email' => 'required|email',
            'g-recaptcha-response' => 'required|captcha',

        ]);
        $user_emails =User::where('email',request('email'));
        return redirect()->back()->withErrors($validator->messages());

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

        Session::flash('flash_message_company_registration', 'Request for Company Registration has been Sent Successfully');
        return Redirect::back();

        // return redirect()->back()->with('flash_message_company_registration', 
        // 'Request for company registration has been sent.');
    }
}
