<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('Language');
Route::get('/change-language/{lang}',"\App\Http\Controllers\HomeController@changeLang")->middleware('Language');

//Operator Baglog
Route::middleware(['auth'])->group(function (){
    Route::get('/baglog-input-form', [App\Http\Controllers\Operator\Baglog\BaglogController::class, 'BaglogInputForm'])->name('BaglogInputForm')->middleware('Language');
    Route::post('/baglog-submit', [App\Http\Controllers\Operator\Baglog\BaglogController::class, 'BaglogSubmit'])->name('BaglogSubmit');
    Route::get('/baglog-monitoring', [App\Http\Controllers\Operator\Baglog\BaglogController::class, 'BaglogMonitoring'])->name('BaglogMonitoring')->middleware('Language');
    Route::post('/baglog-monitoring-update', [App\Http\Controllers\Operator\Baglog\BaglogController::class, 'BaglogMonitoringUpdate'])->name('BaglogMonitoringUpdate');
    Route::get('/baglog-monitoring-delete/{id}', [App\Http\Controllers\Operator\Baglog\BaglogController::class, 'BaglogMonitoringDelete'])->name('BaglogMonitoringDelete');

    //Operator Mylea
    Route::get('/home', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaDashboard'])->name('home')->middleware('Language');
    Route::get('/mylea-monitoring', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaMonitoring'])->name('MyleaMonitoring')->middleware('Language');
    Route::get('/mylea-production-form', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaProductionForm'])->name('MyleaProductionForm')->middleware('Language');
    Route::post('/mylea-production-submit', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaProductionSubmit'])->name('MyleaProductionSubmit');
    Route::get('/mylea-production-details/{id}', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaProductionDetails'])->name('MyleaProductionDetails')->middleware('Language');
    Route::post('/mylea-production-update/', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaProductionUpdate'])->name('MyleaProductionUpdate');
    Route::get('/mylea-contamination-form/{id}', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaContaminationForm'])->name('MyleaContaminationForm')->middleware('Language');
    Route::post('/mylea-contamination-submit', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaContaminationSubmit'])->name('MyleaContaminationSubmit');
    Route::post('/mylea-contamination-update', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaContaminationUpdate'])->name('MyleaContaminationUpdate');
    Route::get('/mylea-contamination-data/{id}', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaContaminationData'])->name('MyleaContaminationData')->middleware('Language');
    Route::get('/mylea-contamination-delete/{id}/{details}', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaContaminationDelete'])->name('MyleaContaminationDelete');
    Route::get('/mylea-harvest-form/{id}', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaHarvestForm'])->name('MyleaHarvestForm')->middleware('Language');
    Route::post('/mylea-harvest-submit', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaHarvestSubmit'])->name('MyleaHarvestSubmit');
    Route::post('/mylea-harvest-update', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaHarvestUpdate'])->name('MyleaHarvestUpdate');
    Route::get('/mylea-harvest-data/{id}', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaHarvestData'])->name('MyleaHarvestData')->middleware('Language');
    Route::get('/mylea-harvest-delete/{id}/{details}', [App\Http\Controllers\Operator\Mylea\MyleaController::class, 'MyleaHarvestDelete'])->name('MyleaHarvestDelete');

    // Operator Finish Good
    Route::get('/finish-good-form/{id}', [App\Http\Controllers\Operator\FinishGood\FinishGoodController::class, 'FinishGoodForm'])->name('FinishGoodForm')->middleware('Language');
    Route::post('/finish-good-submit', [App\Http\Controllers\Operator\FinishGood\FinishGoodController::class, 'FinishGoodSubmit'])->name('FinishGoodSubmit');
    Route::get('/finish-good-data/{id}', [App\Http\Controllers\Operator\FinishGood\FinishGoodController::class, 'FinishGoodData'])->name('FinishGoodData')->middleware('Language');
    Route::get('/finish-good-delete/{id}/{details}', [App\Http\Controllers\Operator\FinishGood\FinishGoodController::class, 'FinishGoodDelete'])->name('FinishGoodDelete');

    // Operator Post Treatment 
    Route::get('/post-treatment-form', [App\Http\Controllers\Operator\PostTreatment\PostTreatmentController::class, 'PostTreatmentForm'])->name('PostTreatmentForm')->middleware('Language');
    Route::post('/post-treatment-submit', [App\Http\Controllers\Operator\PostTreatment\PostTreatmentController::class, 'PostTreatmentSubmit'])->name('PostTreatmentSubmit');
    Route::get('/post-treatment-monitoring', [App\Http\Controllers\Operator\PostTreatment\PostTreatmentController::class, 'PostTreatmentMonitoring'])->name('PostTreatmentMonitoring')->middleware('Language');
    Route::post('/post-treatment-update', [App\Http\Controllers\Operator\PostTreatment\PostTreatmentController::class, 'PostTreatmentUpdate'])->name('PostTreatmentUpdate');
    Route::get('/post-treatment-delete/{id}', [App\Http\Controllers\Operator\PostTreatment\PostTreatmentController::class, 'PostTreatmentDelete'])->name('PostTreatmentDelete');
});
