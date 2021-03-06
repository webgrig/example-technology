<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Polymorphic relation with sectors
    public function sectors(){
        return $this->morphToMany(Sector::class, 'usersectoryables');
    }

    // If user can edit company

    public function canEditCompany($company_id){
        $canUserEditCompany = $this::select('id')
            ->leftJoin('usersectoryables', function ($joun){
            $joun->on('users.id', '=', 'usersectoryables_id');
        })->leftJoin('sectoryables', function ($joun){
            $joun->on('sectoryables.sector_id', '=', 'usersectoryables.sector_id');
        })
            ->where(['usersectoryables_id' => $this->id])
            ->where(['sectoryables_id' => $company_id])
            ->groupBy('id')
            ->count();
        if ($canUserEditCompany) {
            return true;
        }
        return false;
    }
}
