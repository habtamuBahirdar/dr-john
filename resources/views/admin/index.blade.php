{{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\admin\index.blade.php --}}
@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold text-indigo-800 mb-4">Welcome, Admin!</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Appointments Today -->
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500 flex items-center">
            <div class="mr-4">
                <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 4h10M5 11h14M5 15h14M5 19h14"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-bold">Today's Appointments</h2>
                <p class="mt-2 text-gray-700">{{ $totalAppointmentsToday }} appointments scheduled today.</p>
            </div>
        </div>

        <!-- Total Payments Today -->
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500 flex items-center">
            <div class="mr-4">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 10c-4.418 0-8-1.79-8-4v1c0 2.21 3.582 4 8 4s8-1.79 8-4v-1c0 2.21-3.582 4-8 4z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-bold">Total Payments Today</h2>
                <p class="mt-2 text-gray-700">{{ number_format($totalPaymentsToday, 2) }} ETB received today.</p>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500 flex items-center">
            <div class="mr-4">
                <svg class="w-10 h-10 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 14c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm-8 0c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm8-6c0 2.21-1.79 4-4 4s-4-1.79-4-4 1.79-4 4-4 4 1.79 4 4z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-bold">Total Users</h2>
                <p class="mt-2 text-gray-700">{{ $totalUsers }} registered users.</p>
            </div>
        </div>
    </div>
@endsection