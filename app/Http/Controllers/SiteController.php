<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class SiteController extends Controller
{

    public function index(Request $request){
        $sectors = Sector::filledSectors()->take(10)->get();
        return view('home', [
            'sectors' => $sectors,
            'companies' => Company::lastCompanies(10),
            'count_sectors' => Sector::count(),
            'count_companies' => Company::count(),
        ]);
    }
    public function withoutSector(){
        return view('site.without-sector', [
            'title' => 'Without Sector',
        ]);
    }
    public function sector($id = false){
        $sector = $id ? Sector::find(['id' => $id])->first() : false;
        $sectors = !$id ? Sector::filledSectors()->paginate(10) : false;
        $companies = $sector ? $sector->companies()->paginate(8) : false;
        $title = $sector ? $sector->title : 'The sector is empty or does not exist';
        $title = $sectors ? 'List of sectors' : $title;
        return view('site.sector', [
            'sector' => $sector,
            'sectors' => $sectors,
            'companies' => $companies,
            'title' => $title,
        ]);
    }

    public function company($id = false){
        $companies = $id ? false : Company::orderBy('id', 'desc')->paginate(8);
        $company = Company::find(['id' => $id])->first();
        $title = $companies ? 'List of companies' : $company->title;
        return view('site.company', [
            'companies' => $companies,
            'company' => $company,
            'title' => $title,
        ]);
    }
}
