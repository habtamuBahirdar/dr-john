@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit User</h1>

<form action="{{ route('users.update', $user) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow-md">
    @csrf
    @method('PUT')
    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border p-2 rounded">
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded">
    </div>
    <div>
        <label>Password <small>(leave blank to keep current)</small></label>
        <input type="password" name="password" class="w-full border p-2 rounded">
    </div>
    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
