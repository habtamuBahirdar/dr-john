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
        $status = $request->input('status');

        $patients = \App\Models\User::where('usertype', 'patient')
            ->whereHas('appointments', function ($q) use ($status) {
                if ($status) {
                    $q->where('status', $status);
                }
            })
            ->with(['appointments' => function ($q) use ($status) {
                if ($status) {
                    $q->where('status', $status);
                }
                $q->orderBy('appointment_date', 'desc')->orderBy('appointment_time', 'desc');
            }])
            ->get();

        return view('admin.patients.index', compact('patients'));
    }
}
