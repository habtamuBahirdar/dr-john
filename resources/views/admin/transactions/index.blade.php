{{-- filepath: resources/views/admin/transactions/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-indigo-700 mb-6">Transactions</h1>

    {{-- Search and Filter Form --}}
    <form method="GET" action="{{ route('transactions.index') }}" class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            {{-- Search by Transaction Reference or ID --}}
            <div>
                <label for="search" class="block text-gray-700 font-bold mb-2">Search</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                    placeholder="Transaction Ref or ID">
            </div>

            {{-- Filter by Start Date --}}
            <div>
                <label for="start_date" class="block text-gray-700 font-bold mb-2">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            </div>

            {{-- Filter by End Date --}}
            <div>
                <label for="end_date" class="block text-gray-700 font-bold mb-2">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            </div>

            {{-- Submit Button --}}
            <div class="flex items-end">
                <button type="submit"
                    class="bg-indigo-700 text-white px-6 py-2 rounded-lg hover:bg-indigo-600 w-full">
                    Filter
                </button>
            </div>
        </div>
    </form>

    {{-- Transactions Table --}}
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-indigo-700 text-white">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Transaction Reference</th>
                <th class="border border-gray-300 px-4 py-2">Patient</th>
                <th class="border border-gray-300 px-4 py-2">Amount</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr class="text-center">
                    <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $transaction->tx_ref }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ $transaction->appointment->patient->name ?? 'N/A' }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $transaction->amount }} {{ $transaction->currency }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="px-2 py-1 rounded-lg {{ $transaction->status === 'paid' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">No transactions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
</div>
@endsection