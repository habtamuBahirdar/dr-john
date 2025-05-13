{{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\scheduler\schedules\index.blade.php --}}
@extends('scheduler.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-green-700 mb-6">All Schedules</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-md shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($schedules->isEmpty())
        <p class="text-gray-700">No schedules available.</p>
    @else
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Session</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Time</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Max Patients</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $schedule->date }}</td>
                        <td class="border border-gray-300 px-4 py-2 capitalize">{{ $schedule->session }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $schedule->max_patients }}</td>
                        <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                            {{-- Edit Button --}}
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="text-blue-500 hover:underline">
                                Edit
                            </a>

                            {{-- Delete Button --}}
                            <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection