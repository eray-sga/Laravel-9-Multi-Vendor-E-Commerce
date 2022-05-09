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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    //Admin Login Route without admin group
    Route::match(['get','post'],'login', 'AdminController@login');

    Route::group(['middleware'=>['admin']],function(){
        //Admin Dashboard Route 
        Route::get('dashboard', 'AdminController@dashboard');

        //Update admin password
        Route::match(['get','post'],'update-admin-password', 'AdminController@updateAdminPassword');

        //Check admin password
        Route::post('check-admin-password', 'AdminController@checkAdminPassword');

        //Update Admin Details
        Route::match(['get','post'],'update-admin-details','AdminController@updateAdminDetails');

        //Update vendor details
        Route::match(['get','post'],'update-vendor-details/{slug}','AdminController@updateVendorDetails');

        //View admins / subadmins / vendors
        Route::get('admins/{type?}','AdminController@admins');

        //View Vendor Details
        Route::get('view-vendor-details/{id}','AdminController@viewVendorDetails');

        //update admin status
        Route::post('update-admin-status','AdminController@updateAdminStatus');

        //Admin logout
        Route::get('logout', 'AdminController@logout');

        //Sections
        Route::get('sections','SectionController@sections');
        //update section status
        Route::post('update-section-status','SectionController@updateSectionStatus');
        Route::get('delete-section/{id}','SectionController@deleteSection');
    });

});
