<?php
/**
 * Index page Route
 */
Route::get('/', function () {
    return view('front-end.index');
});

/**
 * Route for search
 */
Route::get('/result', function(){
        $discussion = \App\Discussion::where('title', 'like',  '%' . request('query') . '%')->get();
        return view('front-end.results')->with('discussion', $discussion)
                              ->with('title', 'Search results : ' . request('query'))
                              ->with('channels', \App\Channel::take(5)->get())
                              ->with('query', request('query'));
});
/**
 * Discussion Route for all users
 */
Route::get('discussion/{slug}', 'Admin\DiscussionController@show')->name('discussion');
/**
 *  Forum/socialite Routes for all users
 */

Route::get('/forum', 'Admin\ForumController@index')->name('forum');
Route::get('{provider}/auth', 'SocialController@auth')->name('social.auth');
Route::get('/{provider}/redirect', 'SocialController@authCallBack');
Route::get('channel/{slug}', 'Admin\ForumController@channel')->name('channel');

/**
 * Auth:: Routes
 */
Auth::routes();

/**
 * Group middleware Routes auth
 */
Route::group(['middleware' => 'auth'], function() {
	/**
	 * Channels Routes
	 */

    Route::resource('channels', 'Admin\ChannelsController');

    /**
     * Discussion Routes
     */
    
    Route::get('new/discussion', 'Admin\DiscussionController@index')->name('discussions.create');
    Route::post('discussions/store', 'Admin\DiscussionController@store')->name('discussion.store');
    Route::get('/discussion/edit/{slug}', 'Admin\DiscussionController@edit')->name('discussion.edit');
    Route::post('/discussion/update/{id}', 'Admin\DiscussionController@update')->name('discussion.update');
    
    /**
     * Replies Routes & Like/Unlike
     */
    
    Route::post('discussion/reply/{id}', 'Admin\DiscussionController@reply')->name('discussion.reply');
    Route::get('/reply/like/{id}', 'Admin\RepliesController@thumbsUp')->name('reply.like');
    Route::get('/reply/unlike/{id}', 'Admin\RepliesController@thumbsDown')->name('reply.unlike');
    Route::get('/reply/edit/{id}', 'Admin\RepliesController@edit')->name('reply.edit');
    Route::post('/reply/update/{id}', 'Admin\RepliesController@update')->name('reply.update');
    
    /**
     * Watch Routes
     */
    
    Route::get('/watch/{id}', 'Admin\WatchersController@watch')->name('watch');
    Route::get('/un-watch/{id}', 'Admin\WatchersController@unWatch')->name('unwatch');
    /**
     * Points Routes
     */
    
    Route::get('/discussion/best-reply/{id}', 'Admin\RepliesController@best_answer')->name('discussion.best.answer');
    /**
     * Profile Routes
     */
    
    Route::get('/profile', 'Admin\ProfileController@index')->name('profile');
    Route::post('/profile/update', 'Admin\ProfileController@update')->name('profile.update');
});