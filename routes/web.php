<?php

use App\Http\Controllers\RedirectController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;


//=======================================
//Guest/Homepage Routes
//=======================================

Route::middleware('guest')->group(function () {


    Route::get('/', function () {
        return view('home.home');
    })->name('home');

    Route::get('/find-job', function () {
        return view('home.find-job');
    })->name('find-job');

    Route::get('/how-it-works', function () {
        return view('home.how-it-works');
    })->name('how-it-works');

    Route::get('/contact-us', function () {
        return view('home.contact-us');
    })->name('contact-us');

    
});



//===================================================
//      AUTHENTICATION REDIRECTS
//==================================================

Route::group(['middleware' => 'auth'], function() {

    //Main Redirect Controller
    Route::get('redirects', [
        RedirectController::class, 'index'
    ]);


    //===========================
    //Must be Admin
    //===========================
    Route::group(['middleware' => 'admin'], function() {

        //view analytics page
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard'); })
            ->name('admin.dashboard');

        //view analytics page
        Route::get('/admin/analytics', function () {
            return view('admin.analytics'); })
            ->name('admin.analytics');

        // //view upload page
        Route::get('/admin/upload',  [UploadController::class, 'create'])
            ->name('upload.create');

        //view upload page
        Route::post('/admin/upload',  [UploadController::class, 'store'])
            ->name('upload.store');

    });


    //===========================
    //Must be Member
    //===========================
    Route::group(['middleware' => 'member'], function() {

        //view dashboard
        Route::get('/member/dashboard', function () {
            return view('member.dashboard'); })
            ->name('member.dashboard');

        //view payment page
        Route::get('/member/full-access', function () {
            return view('member.full-access'); })
            ->name('member.full-access');

        //view payment page
        Route::get('/member/testimonial', function () {
            return view('member.testimonial'); })
            ->name('member.testimonial');

    });

});

//view installed PHP information
Route::get('/phpinfo', function() {
    phpinfo();
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        // return view('dashboard');
        // return redirect()->route('redirects');
        abort(403, 'Unauthorised action!');
    })->name('dashboard');
});