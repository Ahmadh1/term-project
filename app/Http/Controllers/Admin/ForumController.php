<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Channel;
use App\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;

class ForumController extends Controller
{
    public function index() {
    	 // $discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);
    	switch (request('filter')) {
    		case 'me':
    			$results = Discussion::where('user_id', Auth::id())->paginate(3);
    			break;
    		default:
    			$results = Discussion::orderBy('created_at', 'desc')->paginate(3);
    			break;
    	}
    	return view('front-end.forum', ['discussions' => $results]);
    }

    public function channel($slug) {
    	$channel = Channel::where('slug', $slug)->first();
    	return view('front-end.channel', ['channel' => $channel])->with('discussions', $channel->discussions()->paginate(5));
    }
}
