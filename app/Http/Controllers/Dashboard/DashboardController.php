<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Sector;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Dashboard
    public function dashboard(){
        return view('dashboard.dashboard', [
            'sectors' => Sector::lastSectors(12)->get(),
            'companies' => Company::lastCompanies(12)->get(),
            'count_sectors' => Sector::count(),
            'count_companies' => Company::count(),
        ]);
    }
}
