<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 'name', 'description', 'quantity'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}