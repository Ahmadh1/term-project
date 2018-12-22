<?php

namespace App\Http\Controllers;
use Session;
use SocialAuth;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function auth($provider) {
    	return SocialAuth::authorize($provider);
    }
    public function authCallBack($provider) {
    	SocialAuth::login($provider, function($user, $details) {
    		 // dd($details);
    		$user->avatar = $details->avatar;
    		$user->email = $details->email;
    		$user->name = $details->nickname;
    		$user->save();
    	});
    	Session::flash('msg', 'Successfully logged in  ...');
    	return redirect()->route('forum');
    }
}
