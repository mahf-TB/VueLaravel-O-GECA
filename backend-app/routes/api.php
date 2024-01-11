<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\Agents\AvanceController;
use App\Http\Controllers\Agents\ContratController;
use App\Http\Controllers\Agents\DashboardController;
use App\Http\Controllers\Agents\DetailleController;
use App\Http\Controllers\Agents\RetraiteController;
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
    Route::get('/reinit',  [AuthController::class,'viderTableAgents']);
});

//user
Route::get('/getUser',[UserController::class,'getAllUser'] );
Route::delete('/delete/{id}',[UserController::class,'deleteUser'] );
Route::get('/find/{id}',[UserController::class,'findUser'] );
Route::post('/update/{id}',[UserController::class,'updateUser'] );


//ajouter des uadm sur user
Route::post('/insertUADM/{id}',[UserController::class,'addUserUadm'] );
Route::get('/uadm',[UserController::class,'getUadm'] );
Route::get('/getUserUadm/{id}',[UserController::class,'getUadmUser'] );

//import et export Excel des données 
Route::post('/import',[ExcelController::class,'importExcel'] );

//route pour recuperer les données agents indexDetaille
//avancement
Route::get('/indexAvance',[AvanceController::class,'indexAvance'] );
Route::post('/avanceEntreDate',[AvanceController::class,'avanceDeuxDate'] );
//contratuel
Route::get('/indexContrat',[ContratController::class,'indexContrat'] );
Route::post('/contratDeuxDate',[ContratController::class,'contratDeuxDate'] );
//retraite
Route::get('/indexRetraite',[RetraiteController::class,'indexRetraite'] );
Route::post('/retraiteDeuxDate',[RetraiteController::class,'getRetraiteDeuxDate'] );


// recuperer les données detailler sur un agent 
Route::get('/indexDetaille/{id}',[DetailleController::class,'indexDetaille'] );


Route::get('/countAgents',[DashboardController::class,'countAgents'] );
