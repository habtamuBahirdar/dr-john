<?php
namespace App\Http\Controllers\Scheduler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Show the form for creating a new schedule.
     */
    public function create()
    {
        return view('scheduler.schedules.create');
    }

    /**
     * Store a newly created schedule in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'session' => 'required|in:morning,afternoon',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_patients' => 'required|integer|min:1',
        ]);

        Schedule::create([
            'date' => $request->date,
            'session' => $request->session,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'max_patients' => $request->max_patients,
            'current_patients' => 0, // Default to 0
            'status' => 'open', // Default to open
        ]);

        return redirect()->route('schedules.create')->with('success', 'Schedule created successfully!');
    }
}