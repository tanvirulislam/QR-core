<?php

use Illuminate\Support\Facades\Route;

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

// Route::post('/user-login-store', 'Front\FrontController@user_login_store')->name('user_login_store');
// Route::post('user-registration/store', 'Front\FrontController@registration_store')->name('registration_store');

// Route::post('/user-logout/submit', 'Front\FrontController@logout')->name('user_logout_submit');

Route::post('/pdfFile/store','Front\FrontController@pdf_store')->name('pdf_store');
Route::post('/image/store','Front\FrontController@image_store')->name('image_store');
Route::post('/link/store','Front\FrontController@link_store')->name('link_store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function (){

	Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings','SettingController@index')->name('settings');
    Route::put('profile-update/{id}','SettingController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingController@updatePassword')->name('password.update');

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