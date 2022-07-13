<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UpdateMasterDataController;

use App\Http\Controllers\LecturerController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\LevelController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;

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
Route::redirect('/user/profile', url('master'));

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {

    Route::middleware([ 'auth.admin', ])->group(function(){
        Route::redirect('/', url('master'))->name('base');
        Route::redirect('/index', url('master'))->name('index');
        Route::redirect('/home', url('master'))->name('home');
        Route::redirect('/dashboard', url('master'))->name('dashboard');

        Route::get('update-master-data', UpdateMasterDataController::class);

        Route::get('promote/u/{id}', [PromotionController::class,"index"])->name("promote.user");
        Route::get('promote/s/{id}', [PromotionController::class,"show"])->name("promote.detail");

        Route::group(['prefix'=>'master', 'as'=>'master.'], function () {
            Route::get('/', MasterController::class)->name('index');

            Route::resource('lecturer', LecturerController::class);
            Route::resource('college', CollegeController::class);
            Route::resource('major', MajorController::class);
            Route::resource('requirement', RequirementController::class);
            Route::resource('position', PositionController::class);
            Route::resource('rank', RankController::class);
            Route::resource('level', LevelController::class);
        });
    });

    Route::middleware([ 'auth.lecturer', ])->group(function(){
        Route::get('profile', ProfileController::class)->name("profile");

        Route::resource('promote', PromotionController::class);
    });

});
