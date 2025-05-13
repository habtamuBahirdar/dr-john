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
        // Fetch patients with their appointments (appointments where patient_id = user.id)
        $patients = User::where('usertype', 'patient')
            ->with(['appointments' => function ($q) {
                $q->orderBy('appointment_date', 'desc')->orderBy('appointment_time', 'desc');
            }])
            ->get();

        return view('admin.patients.index', compact('patients'));
    }
}
