<?php

use Illuminate\Support\Facades\Route;
use Mansi\WebsiteAnalytics\Controllers\ModuleWiseLogAnalysisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/analysis',[ModuleWiseLogAnalysisController::class,'index']);
Route::post('/log/{dir}/{data}',[ModuleWiseLogAnalysisController::class,'getFileContent']);
Route::post('/getdata/{dir}/{url?}',[ModuleWiseLogAnalysisController::class,'getFiles']);
Route::view('/index','analytics::index');
Route::view('/log-detail','analytics::log-details')->name('log');