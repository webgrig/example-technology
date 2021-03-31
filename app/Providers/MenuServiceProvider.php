<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Sector;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $this->topMenu();
        $this->companies_without_category();
    }

    // Top menu for site
    public function topMenu(){
        View::composer('layouts.header', function ($view){
            $view->with('sectors', Sector::whereNull('parent_id')->get());
        });
    }

    // Articles without categories
    public function companies_without_category(){
        View::composer('layouts.header', function ($view){
            $companies_without_category = Company::leftJoin('sectoryables', function ($joun){
                $joun->on('companies.id', '=', 'sectoryables.sectoryables_id')
                    ->whereNull('sectoryables_id');
            })->get();
            $view->with([
                'companies_without_category' => $companies_without_category,
            ]);
        });
    }
}
