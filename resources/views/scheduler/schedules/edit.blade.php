{{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\scheduler\schedules\edit.blade.php --}}
@extends('scheduler.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Edit Schedule</h1>

    <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="date" class="block text-gray-700 font-bold mb-2">Date</label>
            <input type="date" id="date" name="date" value="{{ $schedule->date }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200" required>
        </div>
        <div class="mb-4">
            <label for="session" class="block text-gray-700 font-bold mb-2">Session</label>
            <select id="session" name="session" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200" required>
                <option value="morning" {{ $schedule->session === 'morning' ? 'selected' : '' }}>Morning</option>
                <option value="afternoon" {{ $schedule->session === 'afternoon' ? 'selected' : '' }}>Afternoon</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="start_time" class="block text-gray-700 font-bold mb-2">Start Time</label>
            <input type="time" id="start_time" name="start_time" value="{{ $schedule->start_time }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200" required>
        </div>
        <div class="mb-4">
            <label for="end_time" class="block text-gray-700 font-bold mb-2">End Time</label>
            <input type="time" id="end_time" name="end_time" value="{{ $schedule->end_time }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200" required>
        </div>
        <div class="mb-4">
            <label for="max_patients" class="block text-gray-700 font-bold mb-2">Maximum Patients</label>
            <input type="number" id="max_patients" name="max_patients" value="{{ $schedule->max_patients }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200" required>
        </div>
        <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600">
            Update Schedule
        </button>
    </form>
</div>
@endsection