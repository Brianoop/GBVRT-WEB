<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class CaseReceiver extends Model
{
    use HasFactory, Notifiable;

      /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'users_id',
        'user_cases_id'        
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function user_cases()
    {
        return $this->belongsTo(UserCase::class);
    }
}
