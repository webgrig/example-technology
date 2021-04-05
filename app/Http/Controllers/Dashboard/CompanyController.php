<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{

//    public function __construct()
//    {
//
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.companies.index', [
            'companies' => Company::orderBy('id', 'desc')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.companies.create', [
            'company'   => [],
            'sectors'   => Sector::with('children')->whereNull('parent_id')->get(),
            'delimiter' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title'  => 'required|string|max:255',
            'phone' => 'required|string|max:9|unique:companies',
            'email' => 'required|string|email|max:255|unique:companies',
        ]);

        $company = Company::create($request->all());

        // Sectors
        if ($request->input('sectors')){
            $company->sectors()->attach($request->input('sectors'));
        }
        else{
            $company->sectors()->attach(['sector_id' => null]);
        }

        return redirect()->route('dashboard.company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('dashboard.companies.edit', [
            'company'   => $company,
            'sectors'   => Sector::with('children')->whereNull('parent_id')->get(),
            'delimiter' => ''

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $validator = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255'
            ],
            'phone' => [
                'required',
                'string',
                'max:9',
                Rule::unique('companies')->ignore($company->id)
            ],
            'email' => [
                'required',
                'string',
                'max:255',
                'email',
                Rule::unique('companies')->ignore($company->id)
            ],
        ]);
        $company->update($request->all());

        // Sectors
        $company->sectors()->detach();
        if ($request->input('sectors')){
            $company->sectors()->attach($request->input('sectors'));
        }
        else{
            $company->sectors()->attach(['sector_id' => null]);
        }

        return redirect(route('dashboard.company.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->sectors()->detach();
        $company->delete();

        return redirect(route('dashboard.company.index'));
    }
}
