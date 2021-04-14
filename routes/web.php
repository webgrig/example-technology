<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SectorController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\FilterController;

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

Route::get('/filter', [FilterController::class, 'index'])->name('filter');

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/without-sector', [SiteController::class, 'withoutSector'])->name('without-sector');
Route::get('/sector/{id?}', [SiteController::class, 'sector'])->name('sector');
Route::get('/company/{id?}', [SiteController::class, 'company'])->name('company');


Route::group(['prefix' => 'dashboard', 'namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => ['verified']], function (){
    Route::get('/', [DashBoardController::class, 'dashboard'])->name('dashboard.index');
    Route::group(['middleware' => ['user-permission', 'verified']], function (){
        Route::resource('/company', 'CompanyController', ['as'=>'dashboard']);
    });
    Route::group(['middleware' => ['role:super-admin|admin']], function (){
        Route::resource('/sector', 'SectorController', ['as'=>'dashboard']);
    });
    Route::group(['prefix' => 'user_management', 'namespace' => 'UserManagement', 'middleware' => ['role:super-admin']], function(){
        Route::resource('/user', 'UserController', ['as' => 'dashboard.user_management']);
    });
});

Auth::routes(['verify' => true]);
