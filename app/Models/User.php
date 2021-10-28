<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'users_id',
        'email',
        'contact',
        'avatar',
        'password',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function case_receivers()
    {
        return $this->hasMany(CaseReceiver::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaints::class);
    }

    public function user_cases()
    {
        return $this->hasMany(UserCases::class);
    }

    public function activist_data()
    {
        return $this->hasMany(ActivstData::class);
    }

    public function activist_services()
    {
        return $this->hasMany(ActivistServices::class);
    }

    public function reported_users()
    {
        return $this->hasMany(ReportedUsers::class);
    }

}

