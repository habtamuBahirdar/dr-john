@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add User</h1>

    <form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded shadow-md max-w-lg">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="name">Name</label>
            <input class="w-full border px-3 py-2 rounded" type="text" name="name" id="name" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="email">Email</label>
            <input class="w-full border px-3 py-2 rounded" type="email" name="email" id="email" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="password">Password</label>
            <input class="w-full border px-3 py-2 rounded" type="password" name="password" id="password" required>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="usertype">User Type</label>
            <select class="w-full border px-3 py-2 rounded" name="usertype" id="usertype" required>
                <option value="patient">Patient</option>
                <option value="doctor">Doctor</option>
                <option value="scheduler">Scheduler</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Create User</button>
        <a href="{{ route('users.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
    </form>
@endsection
