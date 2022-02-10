<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        try {
            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);
                return redirect('/');

            }else{
                $newUser = new User();
                $newUser->name =  $user->name;
                $newUser->email =  $user->email;
                $newUser->google_id =  $user->id;
                $newUser->password =  encrypt('123456789');
                $newUser->usertype =  'User';
                $newUser->save();   

                Auth::login($newUser);
                return redirect('/');
            }

        } catch (Exception $e) {
            echo '<pre> Error Found </pre> <br>';
            echo '<a href="/"> Go To Home Page </a>';
            // dd($e->getMessage());
        }
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        try {

            $finduser = User::where('facebook_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);
                return redirect('/');

            }else{
            
                $newUser = new User();
                $newUser->name =  $user->name;
                $newUser->email =  $user->email;
                $newUser->facebook_id =  $user->id;
                $newUser->password =  encrypt('123456789');
                $newUser->usertype =  'User';
                $newUser->save();   

            Auth::login($newUser);
            return redirect('/');
            }

        } catch (Exception $e) {
            // echo $e->getMessage();
            echo '<pre> Email Address should be different and unique for facebook and google login. </pre> <br>';
            echo '<a href="/"> Go To Home Page </a>';
        }
    }



}
