@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Patients & Appointments</h1>
    <table class="w-full bg-white shadow-md rounded">
        <thead>
            <tr>
                <th class="p-3">Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Appointments</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
                <tr>
                    <td class="p-3 font-semibold">{{ $patient->name }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ $patient->phone ?? '-' }}</td>
                    <td>
                        @if ($patient->appointments->count())
                            <ul class="list-disc ml-4">
                                @foreach ($patient->appointments as $appointment)
                                    <li>
                                        {{ $appointment->appointment_date }} {{ $appointment->appointment_time }} -
                                        <span class="capitalize">{{ $appointment->status }}</span>
                                        (Payment: {{ $appointment->payment_status }})
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-400">No appointments</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
