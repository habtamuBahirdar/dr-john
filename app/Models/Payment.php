<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

     protected $fillable = [
        'appointment_id',
        'amount',
        'payment_method',
        'status',
        'tx_ref',
        'currency',
    ];


    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}