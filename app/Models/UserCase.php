<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UserCase extends Model
{
    use HasFactory, Notifiable;

       /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'users_id',
        'violences_id',
        'location',
        'details'    
    ];

    public function case_receivers()
    {
        return $this->hasMany(CaseReceiver::class);
    }

    public function case_media()
    {
        return $this->hasMany(CaseMedia::class);
    }

    public function violences()
    {
        return $this->belongsTo(Violence::class);
    }

    public function sub_counties()
    {
        return $this->belongsTo(SubCounties::class);
    }
}
