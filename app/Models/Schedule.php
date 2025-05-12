<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'session',
        'start_time',
        'end_time',
        'max_patients',
        'current_patients',
        'status',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}