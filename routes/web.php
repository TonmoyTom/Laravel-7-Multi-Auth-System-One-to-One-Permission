<?php

use Illuminate\Support\Facades\Auth;
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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/logout', 'Auth\LoginController@userlogout')->name('user.logout');

// Profile...
Route::get('/profile', 'HomeController@profile')->name('user.profile');
Route::get('/profile/change', 'HomeController@profilechange')->name('user.profile.change');

 // Profile Edit...
Route::Post('/update-password', 'HomeController@useroldPassword');
Route::Post('/update-profile-password', 'HomeController@upadtepassword');
Route::get('/update-profile-change', 'HomeController@upadteprofile')->name('user.update.profile.change');
Route::post('/update-profile-change-store', 'HomeController@upadteprofilestore')->name('user.update.profile.store');


Route::group(['prefix' => 'admin'], function() {

         //Admin Login...
        Route::get('/', 'AdminController@index')->name('admin.dashboard')->middleware('auth:admin');
        Route::get('/login', 'Auth\AdminLoginController@showLoginFrom')->name('admin.login')->middleware('guest:admin');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit')->middleware('guest:admin');
        Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

        //Admin Register...

        Route::get('/register', function () {

           abort(404);

        //Route::get('/register', 'Auth\AdminRegisterController@showRegisterFrom')->name('admin.register')->middleware('guest:admin');
        //Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.store')->middleware('guest:admin');

            
        });


        

        //Admin Profile...
        Route::get('/profile', 'AdminController@profile')->name('admin.profile')->middleware('auth:admin');
        Route::get('/profile/change', 'AdminController@profilechange')->name('admin.profile.change')->middleware('auth:admin');

        //Admin Profile Edit...
        //Ajax Start
        Route::Post('/update-password', 'AdminController@oldPassword')->middleware('auth:admin');
        //ajax End

        Route::Post('/update-profile-password', 'AdminController@upadtepassword')->middleware('auth:admin');

         Route::get('update-profile-change', function () {

           abort(404);

            // Route::get('/update-profile-change', 'AdminController@upadteprofile')->name('admin.update.profile.change')->middleware('auth:admin');
            // Route::post('/update-profile-change-store', 'AdminController@upadteprofilestore')->name('admin.update.profile.store')->middleware('auth:admin');


          });  

       
        //Admin Reset Password Edit...

        Route::get('/password/reset', function () {

           abort(404);

            // Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request ');
            // Route::post('/password/reset','Auth\AdminResetPasswordController@reset')->name('admin.password.update');
            // Route::get('/password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

          });

        Route::get('/password/email', function () {

           abort(404);

           // Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email')->middleware('guest:admin');

          });

         //All Admin ...

        Route::get('/alladmins', 'AdminController@alladmins')->name('admins.all')->middleware('auth:admin');
        Route::get('/users/create', 'AdminController@usercreate')->name('admins.create')->middleware('auth:admin');
        Route::Post('/users/create/', 'AdminController@store')->name('admins.store')->middleware('auth:admin');

         //Admin Edit System ...

        Route::get('/users/edit/{id}', 'AdminController@edit')->name('admins.edit ')->middleware('auth:admin');
        Route::Post('/users/edit/{id}', 'AdminController@update')->name('admins.update ')->middleware('auth:admin');
        Route::post('/users/delete/{id}', 'AdminController@delete')->name('admin.delete ')->middleware('auth:admin');

         //Role System

        Route::get('/allroles', 'RoleController@index')->name('role.all')->middleware('auth:admin');
        Route::get('/create/roles', 'RoleController@create')->name('role.create')->middleware('auth:admin');
        Route::post('/create/roles', 'RoleController@store')->name('role.store')->middleware('auth:admin');

           //Role Edit System

        Route::get('/roles/edit/{id}', 'RoleController@edit')->name('role.edit ')->middleware('auth:admin');
        Route::post('/roles/edit/{id}', 'RoleController@update')->name('role.update ')->middleware('auth:admin');
        Route::post('/roles/delete/{id}', 'RoleController@delete')->name('role.delete ')->middleware('auth:admin');
         



});





