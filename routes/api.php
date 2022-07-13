<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\ApiCollegeController;
use App\Http\Controllers\ApiMajorController;
use App\Http\Controllers\ApiRequirementController;
use App\Http\Controllers\ApiPositionController;
use App\Http\Controllers\ApiRankController;
use App\Http\Controllers\ApiLevelController;

use App\Http\Controllers\ApiPromotionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([ 'auth:sanctum', ])->group(function () {

    Route::group([ "prefix"=>"user" ],function(){
        Route::get('dt', [ApiUserController::class,'dt'])->middleware(['ability:user-dt']);
        Route::post('store', [ApiUserController::class,'store'])->middleware(['ability:user-store']);
    });

    Route::group([ "prefix"=>"college" ],function(){
        Route::get('dt', [ApiCollegeController::class,'dt'])->middleware(['ability:college-dt']);
        Route::post('store', [ApiCollegeController::class,'store'])->middleware(['ability:college-store']);
        Route::get('select2', [ApiCollegeController::class,'select2'])->middleware(['ability:college-select2']);
        Route::put('update', [ApiCollegeController::class,'update'])->middleware(['ability:college-update']);
        Route::delete('destroy', [ApiCollegeController::class,'destroy'])->middleware(['ability:college-destroy']);
    });

    Route::group([ "prefix"=>"major" ],function(){
        Route::get('dt', [ApiMajorController::class,'dt'])->middleware(['ability:major-dt']);
        Route::post('store', [ApiMajorController::class,'store'])->middleware(['ability:major-store']);
        Route::put('update', [ApiMajorController::class,'update'])->middleware(['ability:major-update']);
        Route::delete('destroy', [ApiMajorController::class,'destroy'])->middleware(['ability:major-destroy']);
    });

    Route::group([ "prefix"=>"stage" ],function(){
        Route::get('select2', function(){ return config("data.stage"); })->middleware(['ability:stage-select2']);
    });

    Route::group([ "prefix"=>"requirement" ],function(){
        Route::get('dt', [ApiRequirementController::class,'dt'])->middleware(['ability:requirement-dt']);
        Route::post('store', [ApiRequirementController::class,'store'])->middleware(['ability:requirement-store']);
        Route::get('select2', [ApiRequirementController::class,'select2'])->middleware(['ability:requirement-select2']);
        Route::put('update', [ApiRequirementController::class,'update'])->middleware(['ability:requirement-update']);
        Route::delete('destroy', [ApiRequirementController::class,'destroy'])->middleware(['ability:requirement-destroy']);
    });

    Route::group([ "prefix"=>"position" ],function(){
        Route::get('dt', [ApiPositionController::class,'dt'])->middleware(['ability:position-dt']);
        Route::post('store', [ApiPositionController::class,'store'])->middleware(['ability:position-store']);
        Route::get('select2', [ApiPositionController::class,'select2'])->middleware(['ability:position-select2']);
        Route::put('update', [ApiPositionController::class,'update'])->middleware(['ability:position-update']);
        Route::delete('destroy', [ApiPositionController::class,'destroy'])->middleware(['ability:position-destroy']);
    });

    Route::group([ "prefix"=>"rank" ],function(){
        Route::get('dt', [ApiRankController::class,'dt'])->middleware(['ability:rank-dt']);
        Route::post('store', [ApiRankController::class,'store'])->middleware(['ability:rank-store']);
        Route::get('select2', [ApiRankController::class,'select2'])->middleware(['ability:rank-select2']);
        Route::put('update', [ApiRankController::class,'update'])->middleware(['ability:rank-update']);
        Route::delete('destroy', [ApiRankController::class,'destroy'])->middleware(['ability:rank-destroy']);
    });

    Route::group([ "prefix"=>"level" ],function(){
        Route::get('dt', [ApiLevelController::class,'dt'])->middleware(['ability:level-dt']);
        Route::post('store', [ApiLevelController::class,'store'])->middleware(['ability:level-store']);
        Route::put('update', [ApiLevelController::class,'update'])->middleware(['ability:level-update']);
        Route::delete('destroy', [ApiLevelController::class,'destroy'])->middleware(['ability:level-destroy']);
    });

    Route::group([ "prefix"=>"promote" ],function(){
        Route::get('dt', [ApiPromotionController::class,'dt'])->middleware(['ability:promote-dt']);
        Route::post('store', [ApiPromotionController::class,'store'])->middleware(['ability:promote-store']);
        Route::put('update', [ApiPromotionController::class,'update'])->middleware(['ability:promote-update']);
        Route::put('process', [ApiPromotionController::class,'process'])->middleware(['ability:promote-process']);
        Route::put('deny', [ApiPromotionController::class,'deny'])->middleware(['ability:promote-deny']);
        Route::put('approve', [ApiPromotionController::class,'approve'])->middleware(['ability:promote-approve']);
    });

});
