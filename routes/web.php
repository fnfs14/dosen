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

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified' ])->group(function () {
    Route::redirect('/', url('lecturer'))->name('base');
    Route::redirect('/index', url('lecturer'))->name('index');
    Route::redirect('/home', url('lecturer'))->name('home');
    Route::redirect('/dashboard', url('lecturer'))->name('dashboard');

    Route::get('update-master-data', UpdateMasterDataController::class);

    Route::resource('lecturer', LecturerController::class);

    Route::group(['prefix'=>'master', 'as'=>'master.'], function () {
        Route::get('/', MasterController::class)->name('index');

        Route::resource('college', CollegeController::class);
        Route::resource('major', MajorController::class);
        Route::resource('requirement', RequirementController::class);
        Route::resource('position', PositionController::class);
        Route::resource('rank', RankController::class);
    });
});
