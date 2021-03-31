<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Sector;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Dashboard
    public function dashboard(){
        return view('dashboard.dashboard', [
            'sectors' => Sector::lastSectors(5),
            'companies' => Company::lastCompanies(5),
            'count_sectors' => Sector::count(),
            'count_companies' => Company::count(),
        ]);
    }
}
