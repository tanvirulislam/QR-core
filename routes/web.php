<?php

use Illuminate\Support\Facades\Route;



Route::get('/clear', function() {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    return 'Cleared!';
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Front\FrontController@index')->name('index');

Route::get('/user-login', 'Front\FrontController@showLoginForm')->name('user_login');
Route::get('user-registration/', 'Front\FrontController@registration')->name('registration');

Route::post('/pdfFile/store','Front\FrontController@pdf_store')->name('pdf_store');
Route::post('/image/store','Front\FrontController@image_store')->name('image_store');
Route::post('/link/store','Front\FrontController@link_store')->name('link_store');

Route::get('download/link/web/single/image/{id}','Front\FrontController@image')->name('image.detail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function (){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings','SettingController@index')->name('settings');
    Route::put('profile-update/{id}','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');

    Route::get('qr_type','DashboardController@type')->name('qr_type');
    Route::get('download','DashboardController@download')->name('download');

    Route::get('download/link/{id}','DashboardController@download_link')->name('download_link');
    Route::post('/link/destroy/{id}','DashboardController@link_destroy')->name('link_destroy');
    
    Route::get('download/image/{id}','DashboardController@download_image')->name('download_image');
    // Route::get('web/image/{id}','DashboardController@image_web_link')->name('image_web_link');
    Route::get('download/image/eps/{id}','DashboardController@download_image_eps')->name('download_image_eps');
    Route::post('/image/destroy/{id}','DashboardController@image_destroy')->name('image.destroy');

    Route::get('download/pdf/{id}','DashboardController@download_pdf')->name('download_pdf');
    Route::post('/pdf/destroy/{id}','DashboardController@pdf_destroy')->name('pdf_destroy');


	Route::get('link','DashboardController@link')->name('link');
	Route::get('image','DashboardController@image')->name('image');
	Route::get('pdf','DashboardController@pdf')->name('pdf');






	 });

Route::group(['as'=>'user.','prefix'=>'user','namespace'=>'User','middleware'=>['auth','user']], function (){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings','SettingController@index')->name('settings');
    Route::put('profile-update/{id}','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');

	 });

Route::group(['as'=>'agent.','prefix'=>'agent','namespace'=>'Agent','middleware'=>['auth','agent']], function (){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings','SettingController@index')->name('settings');
    Route::put('profile-update/{id}','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');

	 });

Route::group(['as'=>'merchant.','prefix'=>'merchant','namespace'=>'Merchant','middleware'=>['auth','merchant']], function (){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings','SettingController@index')->name('settings');
    Route::put('profile-update/{id}','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');

	 });

Route::group(['as'=>'vip.','prefix'=>'vip','namespace'=>'Vip','middleware'=>['auth','vip']], function (){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings','SettingController@index')->name('settings');
    Route::put('profile-update/{id}','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');

	 });