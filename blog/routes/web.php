<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//https://github.com/alexeymezenin/laravel-best-practices

Route::get('/', function () {
	return view('welcome');
});

Route::get('lang/{lang}','LangController@lang')->name('lang');

#https://docs.spatie.be/laravel-activitylog/v3/introduction
Route::get('logs', function() {
	activity()->log('Hey!, I logged something!');

	$lastActivity = Spatie\Activitylog\Models\Activity::all()->last(); //returns the last logged activity

	return $lastActivity->description; //returns 'Hey!, I logged something';
});

#AdminLTE theme
Route::get('my-theme', function () {

	return view('welcome2');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

# Simple user access control using Middleware
Route::group(['middleware'=>'auth'], function () {
	Route::get('permissions-all-users',['middleware'=>'check.permission:user|admin|superadmin','uses'=>'HomeController@allUsers']);
	Route::get('permissions-admin-superadmin',['middleware'=>'check.permission:admin|superadmin','uses'=>'HomeController@adminSuperadmin']);
	Route::get('permissions-superadmin',['middleware'=>'check.permission:superadmin','uses'=>'HomeController@superadmin']);
});

#ACL spatie: https://itsolutionstuff.com/post/laravel-56-user-roles-and-permissions-acl-using-spatie-tutorialexample.html
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('permissions','PermissionController');
    Route::resource('products','ProductController');
});

Route::get('query-log', function() {
	//get ip
	$clientIP = Request::getClientIp(true);
	var_dump($clientIP);

	// $users = DB::table("users")->toSql();
	// dd($users);

	#way2
	DB::enableQueryLog();
	$user = DB::table("users")->get();
	$query = DB::getQueryLog();
	$query = end($query);
	dd($query);
});

#Post -> We make use of named routes here, which we shall be using shortly in our forms.
Route::get('/posts', 'PostController@index');
Route::post('/post', 'PostController@create');
Route::get('/posts/{id}', 'PostController@read')->name('edit.post');
Route::put('/posts/{id}', 'PostController@update')->name('update.post');
Route::delete('/posts/{id}', 'PostController@delete')->name('destroy.post');


### DEV
#Test send email
Route::get('/send-email', 'DevController@mail');
Route::get('sendmail-markdown', 'DevController@sendMailMarkdown');

#Chunk : https://laravel-news.com/eloquent-tips-tricks
Route::get('chunk-user', 'DevController@chunkUser');

#Event and Queue - https://vegibit.com/8-steps-to-success-with-laravel-events/
#https://www.phpflow.com/php/event-and-listeners-example-using-laravel-5-6/
Route::get('event','DevController@testEvent')->name('test.event');

#Cached
Route::get('test_cache', 'DevController@chunkUser');
Route::get('test_non_cache', 'DevController@testNonCache');

#Generator
Route::get('test_generator', 'DevController@testGenerator');

#QueryBuilder
Route::get('test_qb', 'DevController@testQueryBuilder');
Route::get('test_benmark', 'DevController@testBenmarkBuildAndORM');

#Accessor
Route::get('test_accessor', 'DevController@testAccessor');

#Relationships
Route::get('test', 'DevController@test');
Route::get('test-relationship', 'DevController@testRelationships');

