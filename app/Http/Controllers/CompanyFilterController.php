<?php

namespace App\Http\Controllers;

use App\Http\Resources\RequestToArray as CompanyResource;
use App\Models\Company;
use App\Http\Filters\CompanyFilter;

class CompanyFilterController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(CompanyFilter $filter)
    {
        $companies = Company::filter($filter)->get();
        $resources = CompanyResource::collection($companies);

        return view('site.site-filter', [
            'resources' => $resources,
            'title' => 'Filter',
        ]);
    }
}
