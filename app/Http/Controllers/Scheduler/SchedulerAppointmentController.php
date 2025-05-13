<?php


namespace App\Http\Controllers\Scheduler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Schedule;

class SchedulerAppointmentController extends Controller
{
    // Show the shift page
    public function index()
    {
        // Load today's confirmed appointments
        $appointments = Appointment::where('status', 'confirmed')
            ->whereDate('appointment_date', now()->toDateString())
            ->with('patient') // optional: eager load patient info
            ->get();

        // Get available schedules with open slots
        $availableSchedules = Schedule::where('status', 'open')
            ->whereColumn('current_patients', '<', 'max_patients')
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('scheduler.schedules.shift', compact('appointments', 'availableSchedules'));
    }

    // Process the shift
    public function shift(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'new_schedule_id' => 'required|exists:schedules,id',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);
        $newSchedule = Schedule::findOrFail($request->new_schedule_id);

        // Check if the new schedule has space
        if ($newSchedule->current_patients >= $newSchedule->max_patients) {
            return back()->with('error', 'Selected schedule is full.');
        }

        // Optional: revert current schedule's patient count
        if ($appointment->schedule_id) {
            $oldSchedule = Schedule::find($appointment->schedule_id);
            if ($oldSchedule && $oldSchedule->current_patients > 0) {
                $oldSchedule->decrement('current_patients');
            }
        }

        // Update appointment
        $appointment->update([
            'appointment_date' => $newSchedule->date,
            'appointment_time' => $newSchedule->start_time,
            'schedule_id' => $newSchedule->id,
        ]);

        // Increment the new schedule patient count
        $newSchedule->increment('current_patients');

        return redirect()->back()->with('success', 'Appointment successfully shifted.');
    }
}
