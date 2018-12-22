<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Session;
use App\User;
use App\Reply;
use App\Watch;
use Notification;
use App\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscussionController extends Controller
{

    public function index() {
    	return view('front-end.discuss');
    } // index ends
    public function create() {
    	
    } // create ends 
    public function store(Request $request) {
    	$this->validate($request, [
    		'channel_id' =>	'required',
    			'content'	=> 	'required',
    				'title'	=>	'required'
    	]);
    	$discussion = Discussion::create([
    		'title'	=> $request->title,
    			'content'	=>	$request->content,
    				'slug'	=> str_slug($request->title),
    				'channel_id'	=>	$request->channel_id,
    					'user_id'	=>	Auth::id()
    	]);
    	Session::flash('msg', 'Discussion created');
    	return redirect()->route('discussion', ['slug' => $discussion->slug]);
    } // store ends
    public function show($slug) {
        $discussion = Discussion::where('slug', $slug)->first();
        $best_answer = $discussion->replies()->where('best_answer', 1)->first();
    	return view('front-end.discussions.show')
    			->with('d', Discussion::where('slug', $slug)->first())
                ->with('best_answer', $best_answer);
    } // show ends
    public function reply($id, Request $request) {
        $d = Discussion::find($id);
        
        // dd($request->all(), Auth::id(), $d);
        
        $reply = Reply::create([
            'user_id'   =>  Auth::id(),
                'discussion_id' =>  $id,
                    'content'   =>  $request->content
        ]);
        $reply->user->points += 20; 
        $reply->user->save();
        $watchers = array();
        foreach($d->watchers as $watcher):
            array_push($watchers, User::find($watcher->user_id));
        endforeach;
        Notification::send($watchers, new \App\Notifications\newReplyAdded($d));
       // dd($watchers);

        Session::flash('msg', 'Your replied to this Discussion.');
        return redirect()->back();
    } // reply ends
    public function edit($slug) {
        return view('front-end.discussions.edit', ['discussion' => Discussion::where('slug', $slug)->first() ]);
    } // edit ends
    public function update($id, Request $request) {
        $this->validate($request, [
            'content'   =>  'required'
        ]);
        $d = Discussion::find($id);
        $d->content = $request->content;
        $d->save();
        Session::flash('msg', 'Discussion Updated.');
        return redirect()->route('discussion', ['slug' => $d->slug]);
    } // update ends
}