<?php

namespace App\Http\Controllers;
use App\Http\Filters\QueryFilter;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Sector;
use App\Models\Company;

class FilterController extends Controller{

    public function index(QueryFilter $filter){
        $sectors = Sector::filter($filter)->get();
        $resourcesSectors = JsonResource::collection($sectors);
        $companies = Company::filter($filter)->get();
        $resourcesCompanies = JsonResource::collection($companies);
        return view('site.site-filter', [
            'resourcesSectors' => $resourcesSectors,
            'resourcesCompanies' => $resourcesCompanies,
            'title' => 'Filter',
        ]);
    }
}
