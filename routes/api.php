<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [UserController::class,'store']);
Route::post('login', [AuthController::class,'login']);

Route::get('libraries/get-3', [LibraryController::class,'getTop3']);

Route::group(['prefix' => 'libraries'], function () {
    Route::get('/', [LibraryController::class,'index']);
    Route::post('/', [LibraryController::class,'store']);
    
    Route::group(['prefix' => '/{library}'], function () {
        Route::get('/', [LibraryController::class,'show']);
        Route::put('/', [LibraryController::class,'update']);
        Route::delete('/', [LibraryController::class,'destroy']);
        Route::post('/', [LibraryController::class,'uploadFiles']);
        Route::get('/list', [LibraryController::class,'listFiles']);
        Route::get('/file', [LibraryController::class,'showFiles']);
    });
    Route::delete('/file/{id}', [LibraryController::class,'destroyFiles']);
    Route::post('/update-file/{imageBookFile}', [LibraryController::class,'updateFiles']);
});

Route::get('email',[SendMailController::class,'getList']);
Route::post('email/send',[SendMailController::class,'send']);