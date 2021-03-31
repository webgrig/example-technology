<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    public $timestamps = false;

    // Mass assigned
    protected $fillable = ['title', 'parent_id'];

    // Get children sector
    public function children(){
        return $this->hasMany(self::class, 'parent_id');
    }

    // Polymorphic relation with companies
    public function companies(){
        return $this->morphedByMany(Company::class, 'sectoryables');
    }

    public function scopeLastSectors($query, $count){
        return $query->orderBy('id', 'desc')->take($count)->get();
    }
}
