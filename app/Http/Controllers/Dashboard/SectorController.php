<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.sectors.index', [
            'sectors'=> Sector::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.sectors.create', [
            'sector'    => [],
            'sectors'  => Sector::with('children')->whereNull('parent_id')->get(),
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
            'title' => 'required|string|max:255|unique:sectors'
        ]);
        Sector::create($request->all());
        return redirect()->route('dashboard.sector.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        return view('dashboard.sectors.edit', [
            'sector'    => $sector,
            'sectors'  => Sector::with('children')->whereNull('parent_id')->get(),
            'delimiter' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sector $sector)
    {
        $validator = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sectors')->ignore($sector->id)
            ]
        ]);
        $sector->update($request->all());
        return redirect(route('dashboard.sector.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector)
    {
        $includes_sectors = Sector::where('parent_id', $sector->id);
        $delete_access = false;
        if (!$includes_sectors->count()){
            $delete_access = $sector->companies()->count() ? false : true;
        }
        if ($delete_access){
            $includes_sectors->update(['parent_id' => NULL]);
            $sector->companies()->detach();
            $sector->delete();
            return redirect(route('dashboard.sector.index'));
        }
        return view('dashboard.sectors.index', [
            'sectors'=> Sector::paginate(10),
            'delete_access' => $delete_access,
        ]);
    }
}
