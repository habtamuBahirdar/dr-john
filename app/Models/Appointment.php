<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

  
     protected $fillable = [
        'patient_id',
        'appointment_date',
        'appointment_time',
        'payment_status',
        'status',
        'appointment_type', // Add this to the fillable array
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function medicines()
    {
        return $this->hasMany(Medicine::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}