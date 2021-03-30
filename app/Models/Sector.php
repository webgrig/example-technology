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
}
