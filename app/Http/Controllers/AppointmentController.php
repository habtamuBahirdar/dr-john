<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Show the appointment creation form.
     */
    public function index()
    {
        // Fetch appointments for the logged-in user
        $appointments = Appointment::where('patient_id', auth()->id())->orderBy('appointment_date', 'desc')->get();

        // Return the view with the appointments
        return view('patient.appointments.index', compact('appointments'));
    }
      public function show($id)
    {
        $appointment = Appointment::where('id', $id)->where('patient_id', auth()->id())->firstOrFail();
        return view('patient.appointments.show', compact('appointment'));
    }
    public function edit($id)
    {
        $appointment = Appointment::where('id', $id)->where('patient_id', auth()->id())->firstOrFail();
        return view('patient.appointments.edit', compact('appointment'));
    }

  public function update(Request $request, $id)
    {
        $appointment = Appointment::where('id', $id)->where('patient_id', auth()->id())->firstOrFail();

        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'appointment_type' => 'required|in:normal,urgent',
        ]);

        $appointment->update($request->only('appointment_date', 'appointment_time', 'appointment_type'));

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

       public function destroy($id)
    {
        $appointment = Appointment::where('id', $id)->where('patient_id', auth()->id())->firstOrFail();
        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
    }
    public function create()
{
    // Fetch available schedules
    $schedules = Schedule::where('status', 'open')
        ->where('current_patients', '<', 'max_patients')
        ->orderBy('date', 'asc')
        ->orderBy('start_time', 'asc')
        ->get();

    // Debugging: Log the schedules to check if data is fetched
    \Log::info($schedules);

    return view('patient.appointments.create', compact('schedules'));
}

    /**
     * Handle payment initialization with Chapa.
     */
        public function pay(Request $request)
        {
            $request->validate([
                'appointment_date' => 'required|date|after_or_equal:today',
                'appointment_time' => 'required',
                'amount' => 'required|numeric|min:1',
                'appointment_type' => 'required|in:normal,urgent', // Validate appointment type
            ]);

            // Prepare Chapa payment data
            $data = [
                'amount' => $request->amount,
                'currency' => 'ETB',
                'email' => auth()->user()->email,
                'first_name' => auth()->user()->name,
                'tx_ref' => uniqid('txn_'), // Unique transaction reference
                'callback_url' => route('appointments.callback'),
                'return_url' => route('appointments.callback'),
                'customization[title]' => 'Appointment Payment',
                'customization[description]' => 'Payment for clinic appointment',
            ];

            // Send payment request to Chapa
            $response = Http::withToken(env('CHAPA_SECRET_KEY'))
                ->post(env('CHAPA_BASE_URL') . '/transaction/initialize', $data);

            if ($response->successful()) {
                $paymentUrl = $response->json()['data']['checkout_url'];

                // Save appointment details temporarily in the session
                session([
                    'appointment_data' => $request->only('appointment_date', 'appointment_time', 'amount', 'appointment_type'),
                    'tx_ref' => $data['tx_ref'],
                ]);

                // Redirect to Chapa payment page
                return redirect($paymentUrl);
            }

            return back()->with('error', 'Failed to initialize payment. Please try again.');
        }

    /**
     * Handle Chapa payment callback and save appointment and payment details.
     */
public function callback(Request $request)
{
    $txRef = session('tx_ref');
    $appointmentData = session('appointment_data');

    // Verify payment with Chapa
    $response = Http::withToken(env('CHAPA_SECRET_KEY'))
        ->get(env('CHAPA_BASE_URL') . '/transaction/verify/' . $txRef);

    if ($response->successful() && $response->json()['status'] === 'success') {
        $paymentData = $response->json()['data'];

        // Save appointment
        $appointment = Appointment::create([
            'patient_id' => auth()->id(),
            'appointment_date' => $appointmentData['appointment_date'],
            'appointment_time' => $appointmentData['appointment_time'],
            'payment_status' => 'completed',
            'status' => 'confirmed',
            'appointment_type' => $appointmentData['appointment_type'], // Save appointment type
        ]);

        // Save payment transaction
        Payment::create([
            'tx_ref' => $txRef,
            'amount' => $paymentData['amount'],
            'currency' => $paymentData['currency'],
            'status' => 'paid',
            'appointment_id' => $appointment->id,
        ]);

        // Clear session data
        session()->forget(['appointment_data', 'tx_ref']);

        return redirect()->route('patient.index')->with('success', 'Appointment created and payment recorded successfully!');
    }

    return redirect()->route('patient.index')->with('error', 'Payment verification failed. Please try again.');
}
}