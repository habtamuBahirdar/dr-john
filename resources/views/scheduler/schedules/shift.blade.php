@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Shift Appointment</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="space-y-6">
        <!-- List of Appointments -->
        <h2 class="text-xl font-semibold mb-4">Appointments to Shift</h2>
        <table class="table-auto w-full border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Patient Name</th>
                    <th class="px-4 py-2 text-left">Appointment Date</th>
                    <th class="px-4 py-2 text-left">Appointment Time</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td class="px-4 py-2">{{ $appointment->patient->name }}</td>
                        <td class="px-4 py-2">{{ $appointment->appointment_date }}</td>
                        <td class="px-4 py-2">{{ $appointment->appointment_time }}</td>
                        <td class="px-4 py-2">
                            <!-- Shift Appointment Form -->
                            <form action="{{ route('appointments.shift.process') }}" method="POST">
                                @csrf
                                <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

                                <select name="new_schedule_id" class="p-2 border border-gray-300 rounded">
                                    <option value="" disabled selected>Select New Schedule</option>
                                    @foreach ($availableSchedules as $schedule)
                                        <option value="{{ $schedule->id }}">
                                            {{ $schedule->date }} - {{ $schedule->start_time }} to {{ $schedule->end_time }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit" class="ml-2 p-2 bg-blue-500 text-white rounded">Shift</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
