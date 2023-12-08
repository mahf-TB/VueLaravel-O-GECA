<?php

use App\Http\Controllers\AuthContronller;
use App\Http\Controllers\SectionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//authentification
Route::group(['middleware' => 'api','prefix' => 'auth'],function ($router) {
    Route::post('/login', [AuthContronller::class,'login']);
    Route::post('/addUser',  [AuthContronller::class,'addUser']);
    Route::get('/user',  [AuthContronller::class,'getUser']);

});

//user
Route::get('/getUser',[AuthContronller::class,'getAllUser'] );
Route::get('/delete/{id}',[AuthContronller::class,'deleteUser'] );
Route::get('/find/{id}',[AuthContronller::class,'findUpdateUser'] );
Route::get('/update/{id}',[AuthContronller::class,'updateUser'] );

//section
Route::get('/section',[SectionController::class,'section'] );
