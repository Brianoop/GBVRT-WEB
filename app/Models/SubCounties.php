<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SubCounties extends Model
{
    use HasFactory, Notifiable;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];

    public function user_cases()
    {
        return $this->hasMany(UserCase::class);
    }

}
