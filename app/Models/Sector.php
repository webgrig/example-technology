<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

class Sector extends Model
{
    use HasFactory;


    // Mass assigned
    protected $fillable = ['title', 'parent_id'];

    // Get children sector
    public function children(){
        return $this->hasMany(self::class, 'parent_id')->get();
    }


    // Get parent sector
    public function scopePatentSectorTile(){
        return $this->parent_id ? Sector::find(['id' => $this->parent_id])->first()->title : '';
    }

    // Get filled sectors
    public function scopeFilledSectors(){
        $filledSectors = Sector::select('id', 'title')->leftJoin('sectoryables', function ($joun){
                $joun->on('id', '=', 'sector_id');
            })->whereNotNull('sectoryables_id')
                ->groupBy('id');
        return $filledSectors;
    }

    // Polymorphic relation with companies
    public function companies(){
        return $this->morphedByMany(Company::class, 'sectoryables');
    }

    // Company is children or no?
    public function isCompanyChildren($company_id){
        return DB::table('sectoryables')->where(['sectoryables_id' => $company_id, 'sector_id' =>$this->id])->count();
    }


    // Polymorphic relation with users
    public function users(){
        return $this->morphedByMany(User::class, 'usersectoryables');
    }

    // User is children or no?
    public function isUsersChildren($user_id){
        return DB::table('usersectoryables')->where(['usersectoryables_id' => $user_id, 'sector_id' =>$this->id])->count();
    }

    public function scopeLastSectors($query, $count){
        return $query->orderBy('id', 'desc')->take($count)->get();
    }
}
