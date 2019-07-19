<?php



//make middleware Admin registered in kernel as key admin--->> to make user group(admin or user) 
//namespace for controllers -- prefix for urls
Route::namespace('BackEnd')->prefix('admin')->middleware('admin')->group(function () {
    Route::get('home', 'Home@index')->name('admin.home');
    Route::resource('users', 'Users')->except(['show']);
    Route::resource('categories', 'Categories')->except(['show']);
    Route::resource('skills', 'Skills')->except(['show']);
    Route::resource('tags', 'Tags')->except(['show']);
    Route::resource('pages', 'Pages')->except(['show']);
    Route::resource('videos', 'Videos')->except(['show']);

 //-------when visitor sent message from website admin manage it from dashboard so we make messsages controller for backend------------------------------------------------------------------------------
    Route::resource('messages', 'Messages')->only(['index' , 'destroy' , 'edit']);

    //-----------admin replay to user from dashboard (backend/messages/form)---------------------------------
    Route::post('messages/replay/{id}', 'Messages@replay')->name('message.replay');

    //--------------------------------------------------------------------------------
    Route::post('comments', 'Videos@commentStore')->name('comment.store');
    Route::get('comments/{id}', 'Videos@commentDelete')->name('comment.delete');
    Route::post('comments/{id}', 'Videos@commentUpdate')->name('comment.update');
});
Auth::routes();

/////////////////FrontEnd Routes/////////////////////////////////////////////////

//------------Homepage for registered users---------------------------------------
Route::get('/home', 'HomeController@index')->name('home');

//-------------Landing page for all visitors-------------------------------------------------------
Route::get('/', 'HomeController@welcome')->name('frontend.landing');

// -----------to get videos from navbar (categories& Skills Tab)------------------
Route::get('category/{id}', 'HomeController@category')->name('front.category');
Route::get('skill/{id}', 'HomeController@skills')->name('front.skill');

//------------to get video details when click video in homepage-------------------
Route::get('video/{id}', 'HomeController@video')->name('frontend.video');

//--------------to get tags under video details-----------------------------------
Route::get('tag/{id}', 'HomeController@tags')->name('front.tags');

//------------to contact us ------------------------------------------------------
Route::get('contact-us', 'HomeController@messageStore')->name('contact.store');


//--------------------------------------------------------------------------------
Route::get('page/{id}/{slug?}', 'HomeController@page')->name('front.page');
Route::get('profile/{id}/{slug?}', 'HomeController@profile')->name('front.profile');

// -------------auth middlleware cause only users can add comment and edit------------------
Route::middleware('auth')->group(function () {
    Route::post('comments/{id}', 'HomeController@commentUpdate')->name('front.commentUpdate');
    Route::post('comments/{id}/create', 'HomeController@commentStore')->name('front.commentStore');
    Route::post('profile', 'HomeController@profileUpdate')->name('profile.update');
});