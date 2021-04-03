<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SectorController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CompanyFilterController;

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

Route::get('/filter', [CompanyFilterController::class, 'index'])->name('filter');

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/without-sector', [SiteController::class, 'withoutSector'])->name('without-sector');
Route::get('/sector/{id?}', [SiteController::class, 'sector'])->name('sector');
Route::get('/company/{id?}', [SiteController::class, 'company'])->name('company');


Route::group(['prefix' => 'dashboard', 'namespace' => 'App\Http\Controllers\Dashboard', 'middleware' => ['auth', 'verified', 'role:super|writer']], function (){

    Route::get('/', [DashBoardController::class, 'dashboard'])->name('dashboard.index');
    Route::group(['prefix' => 'user_management', 'namespace' => 'UserManagement', 'middleware' => ['role:super']], function(){
        Route::resource('/user', 'UserController', ['as' => 'dashboard.user_management']);
    });

    Route::resource('/sector', 'SectorController', ['as'=>'dashboard']);
    Route::resource('/company', 'CompanyController', ['as'=>'dashboard']);

    Route::group(['middleware' => ['role:super']], function (){
        Route::get('/sector/{sector}/edit', [SectorController::class, 'edit'])->name('dashboard.sector.edit');
        Route::get('/sector/create', [SectorController::class, 'create'])->name('dashboard.sector.create');
        Route::get('/company/create', [CompanyController::class, 'create'])->name('dashboard.company.create');
    });
});

Auth::routes(['verify' => true]);
