<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CaseMedia extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_cases_id',
        'file_type',
        'file_extension',
        'file_path'
    ];

    public function user_cases()
    {
        return $this->belongsTo(UserCase::class);
    }
}
