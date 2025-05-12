<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Payment;
use App\Models\Medicine;

class AppointmentController extends Controller

{

             public function create()
            {
                return view('patient.appointments.create'); // Ensure this view exists
            }
    public function pay(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'amount' => 'required|numeric|min:1',
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
                'appointment_data' => $request->only('appointment_date', 'appointment_time', 'amount'),
                'tx_ref' => $data['tx_ref'],
            ]);

            // Redirect to Chapa payment page
            return redirect($paymentUrl);
        }

        return back()->with('error', 'Failed to initialize payment. Please try again.');
    }

    public function callback(Request $request)
    {
        $txRef = session('tx_ref');
        $appointmentData = session('appointment_data');

        // Verify payment with Chapa
        $response = Http::withToken(env('CHAPA_SECRET_KEY'))
            ->get(env('CHAPA_BASE_URL') . '/transaction/verify/' . $txRef);

        if ($response->successful() && $response->json()['status'] === 'success') {
            // Payment successful, save appointment
            Appointment::create([
                'patient_id' => auth()->id(),
                'appointment_date' => $appointmentData['appointment_date'],
                'appointment_time' => $appointmentData['appointment_time'],
                'payment_status' => 'completed',
                'status' => 'confirmed',
            ]);

            // Clear session data
            session()->forget(['appointment_data', 'tx_ref']);

            return redirect()->route('patient.index')->with('success', 'Appointment created successfully!');
        }

        return redirect()->route('patient.index')->with('error', 'Payment verification failed. Please try again.');
    }
}