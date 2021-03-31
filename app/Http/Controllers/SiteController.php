<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Sector;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function sector($id = false){
        $sector = Sector::find($id);
        $companies = $sector ? $sector->companies()->paginate(5) : [];
        return view('site.sector', [
            'sector' => $sector,
            'companies' => $companies,
        ]);
    }

    public function company($id = false){
        $company = Company::find($id);
        return view('site.company', [
            'company' => $company,
        ]);
    }
}
