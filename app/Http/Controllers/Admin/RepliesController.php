<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Session;
use App\Like;
use App\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepliesController extends Controller
{
    public function thumbsUp($id) {
    	Like::create([
    		'reply_id'	=>	$id,
    			'user_id'	=> Auth::id()
    	]);
    	Session::flash('msg', 'liked this reply');
    	return redirect()->back();
    } // thumbsUp ends

    public function thumbsDown($id) {
    	$like = Like::where('reply_id', $id)->where('user_id', Auth::id())->first();
    	$like->delete();
    	Session::flash('msg', 'Unliked this reply');
    	return redirect()->back();
    } // thumbsDown ends
    public function best_answer($id){
        $reply = Reply::find($id);
        $reply->best_answer = 1;
        $reply->save();
        $reply->user->points += 100;
        $reply->user->save();
        Session::flash('success', 'Reply has been marked as the best answer.');
        return redirect()->back();
    } // best_answer ends
    public function edit($id) {
        return view('front-end.replies.edit', ['reply' => Reply::where('id', $id)->first()]);
    } // edit ends
    public function update($id, Request $r) {
        $this->validate($r, [
            'content'   => 'required'
        ]);
        $reply = Reply::find($id);
        $reply->content = $r->content;
        $reply->save();
        Session::flash('msg', 'Reply Updated.');
        return redirect()->route('discussion', ['slug' => $reply->discussion->slug] );
    } // update ends
} // RepliesController ends
