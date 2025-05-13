<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        // Only patients who have at least one appointment
        $patients = User::where('usertype', 'patient')
            ->whereHas('appointments')
            ->with(['appointments' => function ($q) {
                $q->orderBy('appointment_date', 'desc')->orderBy('appointment_time', 'desc');
            }])
            ->get();

        return view('admin.patients.index', compact('patients'));
    }
}
