{{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\patient\appointments\create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make an Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-blue-700 mb-6">Make an Appointment</h1>
        {{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\patient\appointments\create.blade.php --}}
        <form action="{{ route('appointments.pay') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="appointment_date" class="block text-gray-700 font-bold mb-2">Appointment Date</label>
                <input type="date" id="appointment_date" name="appointment_date" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
            </div>
            <div class="mb-4">
                <label for="appointment_time" class="block text-gray-700 font-bold mb-2">Appointment Time</label>
                <input type="time" id="appointment_time" name="appointment_time" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
            </div>
            <input type="hidden" name="amount" value="100">
            <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600">
                Pay & Confirm Appointment
            </button>
        </form>
        <div class="mt-6">
            <h2 class="text-xl font-bold text-blue-700 mb-4">Payment Information</h2>
            <p class="text-gray-600">Please proceed to payment to confirm your appointment.</p>
            <ul class="list-disc list-inside mt-2">
                <li>Amount: $100</li>
                <li>Payment Method: Credit/Debit Card</li>
            </ul>
            <p class="mt-4">You will receive a confirmation email once the payment is processed.</p>
        </div>
    </div>
</body>
</html>