<?php

namespace App\Http\Controllers;

use App\User;
use App\Enquire;
use App\PropertyCities;
use App\CompanyRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyRegistrationMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CompanyRegistrationController extends Controller
{
    public function index()
    {
        return view('front.pages.auth.company_registration');
    }
    public function post_registration(Request $request)
    {
        
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'company_name' => 'required',
            'city' => 'required',
            'job_title' => 'required',
            'images' => 'required',
            'email' => 'required|email|unique:company_registrations,email',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        if($request->has('images'))
        {
            foreach($request->file('images') as $image)
            {
                $image_name = 'Company_Registration_' . time() . rand(1,1000).'.'.$image->extension();
                $image->move(public_path('upload/company_registration'),$image_name);
            } 
        }

        $cr = new CompanyRegistration();
        $cr->first_name = request('first_name');
        $cr->last_name = request('last_name');
        $cr->email = request('email');
        $cr->phone = request('phone');
        $cr->company_name = request('company_name');
        $cr->city = request('city');
        $cr->job_title = request('job_title');
        $cr->email = request('email');
        $cr->images = implode('|',request('images'));
       
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
        return redirect()->back();

    }
}
