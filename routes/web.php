<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UpdateMasterDataController;
use App\Http\Controllers\DashboardController;

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
Route::redirect('/user/profile', url('dashboard'));

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {

    Route::middleware([ 'auth.admin', ])->group(function(){
        Route::redirect('/', url('dashboard'))->name('base');
        Route::redirect('/index', url('dashboard'))->name('index');
        Route::redirect('/home', url('dashboard'))->name('home');
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        Route::get('update-master-data', UpdateMasterDataController::class);

        Route::get('promote/u/{id}', [PromotionController::class,"index"])->name("promote.user");
        Route::get('promote/s/All', [PromotionController::class,"list"])->name("promote.list");
        Route::get('promote/s/Draf', [PromotionController::class,"draf"])->name("promote.draf");
        Route::get('promote/s/Diajukan', [PromotionController::class,"diajukan"])->name("promote.diajukan");
        Route::get('promote/s/Ditolak', [PromotionController::class,"ditolak"])->name("promote.ditolak");
        Route::get('promote/s/Disetujui', [PromotionController::class,"disetujui"])->name("promote.disetujui");
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
