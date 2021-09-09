<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Violence extends Model
{
    use HasFactory, Notifiable;

           /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [      
        'name',
        'description'
    ];

    public function user_cases()
    {
        return $this->hasMany(UserCase::class);
    }
}
