<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // Mass assigned
    protected $fillable = ['title', 'phone', 'email'];

    // Polymorphic relation with sectors
    public function sectors(){
        return $this->morphToMany(Sector::class, 'sectoryables');
    }

    public function scopeLastCompanies($query, $count){
        return $query->orderBy('id', 'desc')->take($count)->get();
    }
}
