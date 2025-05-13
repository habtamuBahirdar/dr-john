@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Manage Users</h1>

    <a href="{{ route('users.create') }}"
        class="mb-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        + Add User
    </a>

    <form method="GET" action="{{ route('users.index') }}" class="mb-4 flex flex-wrap gap-2 items-end">
        <div>
            <label for="usertype" class="block text-sm font-medium">User Type</label>
            <select name="usertype" id="usertype" class="border rounded px-2 py-1">
                <option value="">All</option>
                <option value="patient" {{ request('usertype') == 'patient' ? 'selected' : '' }}>Patient</option>
                <option value="doctor" {{ request('usertype') == 'doctor' ? 'selected' : '' }}>Doctor</option>
                <option value="scheduler" {{ request('usertype') == 'scheduler' ? 'selected' : '' }}>Scheduler</option>
                <option value="admin" {{ request('usertype') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div>
            <label for="sort" class="block text-sm font-medium">Sort By</label>
            <select name="sort" id="sort" class="border rounded px-2 py-1">
                <option value="created_desc" {{ request('sort') == 'created_desc' ? 'selected' : '' }}>Newest</option>
                <option value="created_asc" {{ request('sort') == 'created_asc' ? 'selected' : '' }}>Oldest</option>
                <option value="alpha_asc" {{ request('sort') == 'alpha_asc' ? 'selected' : '' }}>A-Z</option>
                <option value="alpha_desc" {{ request('sort') == 'alpha_desc' ? 'selected' : '' }}>Z-A</option>
            </select>
        </div>
        <div>
            <label for="search" class="block text-sm font-medium">Search</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}"
                class="border rounded px-2 py-1" placeholder="Name or Email">
        </div>
        <div>
            <label for="date_from" class="block text-sm font-medium">Registered From</label>
            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                class="border rounded px-2 py-1">
        </div>
        <div>
            <label for="date_to" class="block text-sm font-medium">Registered To</label>
            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                class="border rounded px-2 py-1">
        </div>
        <div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Filter</button>
        </div>
    </form>

    <table class="w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-indigo-100">
                <th class="p-3">Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="border-t">
                    <td class="p-3">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->usertype) }}</td>
                    <td>
                        <form action="{{ route('users.toggle', $user) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="text-sm {{ $user->active ? 'text-green-600' : 'text-green-600' }}">
                                {{ $user->active ? 'Active' : 'Active' }}
                            </button>
                        </form>
                    </td>
                    <td class="text-right space-x-2 p-3">
                        <a href="{{ route('users.edit', $user) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
