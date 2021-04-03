<?php

namespace App\Http\Controllers;

use App\Http\Resources\Filter as FilterResource;
use App\Models\Company;

class FilterController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $company = Company::limit(10)->get();

        return FilterResource::collection($company);
    }
}
