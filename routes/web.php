<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Operator Baglog
Route::get('/en/baglog-input-form', [App\Http\Controllers\Operator\Baglog\BaglogController::class, 'BaglogInputForm'])->name('BaglogInputForm');
Route::post('/en/baglog-submit', [App\Http\Controllers\Operator\Baglog\BaglogController::class, 'BaglogSubmit'])->name('BaglogSubmit');
Route::get('/en/baglog-monitoring', [App\Http\Controllers\Operator\Baglog\BaglogController::class, 'BaglogMonitoring'])->name('BaglogMonitoring');
Route::post('/en/baglog-monitoring-update', [App\Http\Controllers\Operator\Baglog\BaglogController::class, 'BaglogMonitoringUpdate'])->name('BaglogMonitoringUpdate');
Route::get('/en/baglog-monitoring-delete/{id}', [App\Http\Controllers\Operator\Baglog\BaglogController::class, 'BaglogMonitoringDelete'])->name('BaglogMonitoringDelete');

//Operator Mylea
Route::get('/en/mylea-production-form', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaProductionForm'])->name('MyleaProductionForm');
Route::post('/en/mylea-production-submit', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaProductionSubmit'])->name('MyleaProductionSubmit');
