{{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\patient\appointments\show.blade.php --}}
@extends('patient.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-blue-700 mb-6">Appointment Details</h1>
    <p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
    <p><strong>Time:</strong> {{ $appointment->appointment_time }}</p>
    <p><strong>Type:</strong> {{ ucfirst($appointment->appointment_type) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
    <a href="{{ route('appointments.index') }}" class="text-blue-500 hover:underline mt-4 inline-block">Back to Appointments</a>
</div>
@endsection