<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index() {
    	return view('front-end.profiles.index', array('user' => Auth::user()));
    } // index ends
    public function update(Request $r) {
    	if ($r->hasFile('avatar')) {
    		$avatar = $r->avatar;
    		$avatarNewName = time() . $avatar->getClientOriginalName();
    		$avatar->move('avatars/', $avatarNewName);
            $user = User::find(Auth::user()->id);
    		$user->avatar = asset('/avatars') . '/' . $avatarNewName; 
            $user->save();
    	} // end if
    	Session::flash('msg', 'Profile Updated.');
    	return redirect()->route('profile');
    }
}
