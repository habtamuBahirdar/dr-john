{{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\patient\appointments\index.blade.php --}}
@extends('patient.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-blue-700 mb-6">My Appointments</h1>

    @if ($appointments->isEmpty())
        <p class="text-gray-700">You have no appointments yet.</p>
    @else

      @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg shadow-md mb-4">
                {{ session('success') }}
            </div>
        @endif
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Time</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Type</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $appointment->appointment_date }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $appointment->appointment_time }}</td>
                        <td class="border border-gray-300 px-4 py-2 capitalize">{{ $appointment->appointment_type }}</td>
                        <td class="border border-gray-300 px-4 py-2 capitalize">{{ $appointment->status }}</td>
                        <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                            {{-- View Icon --}}
                            <a href="{{ route('appointments.show', $appointment->id) }}" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-eye"></i>
                            </a>

                            {{-- Edit Icon (only for confirmed appointments) --}}
                            @if ($appointment->status === 'confirmed')
                                <a href="{{ route('appointments.edit', $appointment->id) }}" class="text-green-500 hover:text-green-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif

                            {{-- Delete Icon (only for pending appointments) --}}
                            @if ($appointment->status === 'pending')
                                <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection