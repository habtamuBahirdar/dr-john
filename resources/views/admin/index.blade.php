@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold text-indigo-800 mb-4">Welcome, Admin!</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Example cards -->
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
            <h2 class="text-lg font-bold">Today's Appointments</h2>
            <p class="mt-2 text-gray-700">23 appointments scheduled today.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
            <h2 class="text-lg font-bold">Active Doctors</h2>
            <p class="mt-2 text-gray-700">10 doctors online.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
            <h2 class="text-lg font-bold">Pending Approvals</h2>
            <p class="mt-2 text-gray-700">5 new user signups.</p>
        </div>
    </div>
@endsection
