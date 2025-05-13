@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Patients & Appointments</h1>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('patients.index') }}" class="mb-4 flex items-center gap-2">
        <label for="status" class="font-semibold">Filter by Status:</label>
        <select name="status" id="status" class="border rounded px-2 py-1">
            <option value="">All</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <label for="time_of_day" class="font-semibold ml-4">Time of Day:</label>
        <select name="time_of_day" id="time_of_day" class="border rounded px-2 py-1">
            <option value="">All</option>
            <option value="morning" {{ request('time_of_day') == 'morning' ? 'selected' : '' }}>Morning (00:00-11:59)
            </option>
            <option value="afternoon" {{ request('time_of_day') == 'afternoon' ? 'selected' : '' }}>Afternoon (12:00-23:59)
            </option>
        </select>
        <label for="appointment_date" class="font-semibold ml-4">Date:</label>
        <input type="date" name="appointment_date" id="appointment_date" value="{{ request('appointment_date') }}"
            class="border rounded px-2 py-1">
        <button type="submit"
            class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded text-xs">Filter</button>
        @if (request('status') || request('time_of_day') || request('appointment_date'))
            <a href="{{ route('patients.index') }}" class="text-indigo-600 underline text-xs ml-2">Clear</a>
        @endif
    </form>
    <!-- End Filter Form -->

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-lg rounded-lg border">
            <thead>
                <tr class="bg-indigo-100 text-indigo-900 uppercase text-xs tracking-wider">
                    <th class="p-3 font-semibold border-b text-center">ID</th>
                    <th class="p-3 font-semibold border-b text-center">Name</th>
                    <th class="p-3 font-semibold border-b text-center">Email</th>
                    <th class="p-3 font-semibold border-b text-center">Phone</th>
                    <th class="p-3 font-semibold border-b text-center">Patient ID</th>
                    <th class="p-3 font-semibold border-b text-center">Staff ID</th>
                    <th class="p-3 font-semibold border-b text-center">Appointment Date</th>
                    <th class="p-3 font-semibold border-b text-center">Appointment Time</th>
                    <th class="p-3 font-semibold border-b text-center">Payment Status</th>
                    <th class="p-3 font-semibold border-b text-center">Status</th>
                    <th class="p-3 font-semibold border-b text-center">Appointment Type</th>
                    <th class="p-3 font-semibold border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                    @php
                        $filteredAppointments = $patient->appointments;
                        if (request('status')) {
                            $filteredAppointments = $filteredAppointments->where('status', request('status'));
                        }
                        if (request('time_of_day') == 'morning') {
                            $filteredAppointments = $filteredAppointments->filter(function ($a) {
                                return \Carbon\Carbon::parse($a->appointment_time)->format('H') < 12;
                            });
                        }
                        if (request('time_of_day') == 'afternoon') {
                            $filteredAppointments = $filteredAppointments->filter(function ($a) {
                                return \Carbon\Carbon::parse($a->appointment_time)->format('H') >= 12;
                            });
                        }
                        if (request('appointment_date')) {
                            $filteredAppointments = $filteredAppointments->where(
                                'appointment_date',
                                request('appointment_date'),
                            );
                        }
                    @endphp
                    @if ($filteredAppointments->count())
                        @foreach ($filteredAppointments as $appointment)
                            <tr class="hover:bg-indigo-50 transition-colors">
                                <td class="p-2 border-b text-center">{{ $appointment->id }}</td>
                                <td class="p-2 border-b text-center font-semibold">{{ $patient->name }}</td>
                                <td class="p-2 border-b text-center">{{ $patient->email }}</td>
                                <td class="p-2 border-b text-center">{{ $patient->phone ?? '-' }}</td>
                                <td class="p-2 border-b text-center">{{ $appointment->patient_id }}</td>
                                <td class="p-2 border-b text-center">{{ $appointment->staff_id ?? '-' }}</td>
                                <td class="p-2 border-b text-center">{{ $appointment->appointment_date }}</td>
                                <td class="p-2 border-b text-center">{{ $appointment->appointment_time }}</td>
                                <td class="p-2 border-b capitalize text-center">
                                    <span
                                        class="@if ($appointment->payment_status == 'completed') text-green-600 @elseif($appointment->payment_status == 'failed') text-red-600 @else text-yellow-600 @endif">
                                        {{ $appointment->payment_status }}
                                    </span>
                                </td>
                                <td class="p-2 border-b capitalize text-center">
                                    <span
                                        class="@if ($appointment->status == 'completed') text-green-600 @elseif($appointment->status == 'cancelled') text-red-600 @elseif($appointment->status == 'pending') text-yellow-600 @else text-blue-600 @endif">
                                        {{ $appointment->status }}
                                    </span>
                                </td>
                                <td class="p-2 border-b capitalize text-center">
                                    <span
                                        class="@if ($appointment->appointment_type == 'urgent') text-red-600 font-bold @else text-gray-700 @endif">
                                        {{ $appointment->appointment_type }}
                                    </span>
                                </td>
                                <td class="p-2 border-b text-center">
                                    @if ($appointment->status !== 'completed')
                                        <form action="{{ route('appointments.complete', $appointment->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Mark this appointment as completed?');">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">
                                                Complete
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-green-600 font-semibold">Completed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="p-2 text-center text-gray-400" colspan="12">
                                {{ $patient->name }} ({{ $patient->email }}) has no
                                appointments
                                @if (request('status') || request('time_of_day') || request('appointment_date'))
                                    with
                                    @if (request('status'))
                                        status "{{ request('status') }}"
                                    @endif
                                    @if (request('status') && (request('time_of_day') || request('appointment_date')))
                                        and
                                    @endif
                                    @if (request('time_of_day'))
                                        time of day "{{ request('time_of_day') }}"
                                    @endif
                                    @if ((request('status') || request('time_of_day')) && request('appointment_date'))
                                        and
                                    @endif
                                    @if (request('appointment_date'))
                                        date "{{ request('appointment_date') }}"
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
