<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\Filterable;
use Illuminate\Http\Request;

class Company extends Model
{
    use HasFactory, Filterable;

    // Mass assigned
    protected $fillable = ['title', 'phone', 'email'];
    protected $filterableFields = ['title', 'phone', 'email'];

    // Polymorphic relation with sectors
    public function sectors(){
        return $this->morphToMany(Sector::class, 'sectoryables');
    }

    public function scopeLastCompanies($query, $count){
        return $query->orderBy('id', 'desc')->take($count);
    }

    // List of users who can edit company

    public function listUsersOfCompany(){
        $q = $this::select(['name'])
            ->leftJoin('sectoryables', function ($joun){
                $joun->on('companies.id', '=', 'sectoryables_id');
            })->leftJoin('usersectoryables', function ($joun){
                $joun->on('usersectoryables.sector_id', '=', 'sectoryables.sector_id');
            })
            ->leftJoin('users', function ($joun){
                $joun->on('users.id', '=', 'usersectoryables_id');
            })
            ->where('users.name', '!=', NULL)
            ->where(['sectoryables_id' => $this->id])
            ->groupBy('usersectoryables_id')
            ->get();
        return $q;
    }
}
