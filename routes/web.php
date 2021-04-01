<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SectorController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\SiteController;

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

//Route::group(['prefix' => false ], function (){
//
//});

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/without-sector', [SiteController::class, 'withoutSector'])->name('without-sector');
Route::get('/sector/{id?}', [SiteController::class, 'sector'])->name('sector');
Route::get('/company/{id?}', [SiteController::class, 'company'])->name('company');




Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'verified']], function (){
    Route::get('/', [DashBoardController::class, 'dashboard'])->name('dashboard.index');
    Route::resource('/sector', SectorController::class, ['as'=>'dashboard']);
    Route::resource('/company', CompanyController::class, ['as'=>'dashboard']);
});

Auth::routes(['verify' => true]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');
