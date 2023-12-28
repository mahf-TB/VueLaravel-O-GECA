<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExcelController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//authentification
Route::group(['middleware' => 'api','prefix' => 'auth'],function ($router) {
    Route::post('/login', [AuthController::class,'login']);
    Route::post('/addUser',  [AuthController::class,'addUser']);
    Route::get('/user',  [AuthController::class,'getUser']);

});

//user
Route::get('/getUser',[UserController::class,'getAllUser'] );
Route::delete('/delete/{id}',[UserController::class,'deleteUser'] );
Route::get('/find/{id}',[UserController::class,'findUser'] );
Route::post('/update/{id}',[UserController::class,'updateUser'] );

//ajouter des uadm sur user
Route::post('/insertUADM/{id}',[UserController::class,'addUserUadm'] );
Route::get('/uadm',[UserController::class,'getUadm'] );

//importation des données 
Route::post('/import',[ExcelController::class,'importExcel'] );

//route pour recuperer les données agents
Route::get('/allAgents',[AgentController::class,'getAgentsAvance'] );
Route::get('/allAgentsContrat',[AgentController::class,'getAgentsContrat'] );
Route::get('/allAgentsRetraite',[AgentController::class,'getAgentsRetraite'] );
