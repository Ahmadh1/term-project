<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Session;
use App\Watch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WatchersController extends Controller
{
    public function watch($id){
    	Watch::create([
    		'discussion_id'	=>	$id,
    			'user_id'	=>	Auth::id()
    	]);
    	Session::flash('msg', 'You are watching this discussion.');
    	return redirect()->back();
    }

    public function unWatch($id){
    	$unwatch = Watch::where('discussion_id', $id)->where('user_id', Auth::id());
    	$unwatch->delete();
    	Session::flash('msg', 'You are no longer watching this discussion.');
    	return redirect()->back();
    }
}
