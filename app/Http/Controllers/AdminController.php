<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Payment;

class AdminController extends Controller
{
    public function index()
    {
        if (auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'user') {
                return view('dashboard');
            } else if ($usertype == 'admin') {
                // Total appointments today
                $totalAppointmentsToday = Appointment::whereDate('appointment_date', today())->count();

                // Total payments today
                $totalPaymentsToday = Payment::whereDate('created_at', today())->sum('amount');

                // Total users
                $totalUsers = User::count();

                // Pass the totals to the view
                return view('admin.index', compact('totalAppointmentsToday', 'totalPaymentsToday', 'totalUsers'));
            } else if ($usertype == 'patient') {
                return view('patient.index');
            } else if ($usertype == 'scheduler') {
                return view('scheduler.index');
            } else {
                return redirect()->back();
            }
        }
    }
}