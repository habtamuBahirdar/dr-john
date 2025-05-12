{{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\patient\appointments\edit.blade.php --}}
@extends('patient.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-blue-700 mb-6">Edit Appointment</h1>
    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="appointment_date" class="block text-gray-700 font-bold mb-2">Appointment Date</label>
            <input type="date" id="appointment_date" name="appointment_date" value="{{ $appointment->appointment_date }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
        </div>
        <div class="mb-4">
            <label for="appointment_time" class="block text-gray-700 font-bold mb-2">Appointment Time</label>
            <input type="time" id="appointment_time" name="appointment_time" value="{{ $appointment->appointment_time }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
        </div>
        <div class="mb-4">
            <label for="appointment_type" class="block text-gray-700 font-bold mb-2">Appointment Type</label>
            <select id="appointment_type" name="appointment_type" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
                <option value="normal" {{ $appointment->appointment_type === 'normal' ? 'selected' : '' }}>Normal</option>
                <option value="urgent" {{ $appointment->appointment_type === 'urgent' ? 'selected' : '' }}>Urgent</option>
            </select>
        </div>
        <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600">Update Appointment</button>
    </form>
</div>
@endsection