{{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\patient\appointments\create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make an Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script>
        function updateAmount() {
            const appointmentType = document.getElementById('appointment_type').value;
            const amountInput = document.getElementById('amount');
            if (appointmentType === 'urgent') {
                amountInput.value = 200; // Set amount for urgent appointments
            } else {
                amountInput.value = 100; // Set amount for normal appointments
            }
        }

        function updateTimes() {
            const dateSelect = document.getElementById('appointment_date');
            const timeSelect = document.getElementById('appointment_time');
            const selectedDate = dateSelect.value;

            // Hide all time options initially
            const timeOptions = timeSelect.querySelectorAll('option');
            timeOptions.forEach(option => {
                option.style.display = 'none';
                option.disabled = true;
            });

            // Show only the time options for the selected date
            timeOptions.forEach(option => {
                if (option.dataset.date === selectedDate) {
                    option.style.display = 'block';
                    option.disabled = false;
                }
            });

            // Reset the time selection
            timeSelect.value = '';
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-blue-700 mb-6">Make an Appointment</h1>
        <form action="{{ route('appointments.pay') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="appointment_date" class="block text-gray-700 font-bold mb-2">Appointment Date</label>
                <select id="appointment_date" name="appointment_date" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" onchange="updateTimes()" required>
                    <option value="" disabled selected>Select a date</option>
                    @foreach ($schedules->groupBy('date') as $date => $dateSchedules)
                        <option value="{{ $date }}">{{ $date }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="appointment_time" class="block text-gray-700 font-bold mb-2">Appointment Time</label>
                <select id="appointment_time" name="appointment_time" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
                    <option value="" disabled selected>Select a time</option>
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule->start_time }} - {{ $schedule->end_time }}" data-date="{{ $schedule->date }}">
                            {{ $schedule->start_time }} - {{ $schedule->end_time }} ({{ ucfirst($schedule->session) }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="appointment_type" class="block text-gray-700 font-bold mb-2">Appointment Type</label>
                <select id="appointment_type" name="appointment_type" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" onchange="updateAmount()" required>
                    <option value="normal">Normal</option>
                    <option value="urgent">Urgent</option>
                </select>
            </div>
            <input type="hidden" id="amount" name="amount" value="100"> {{-- Default amount for normal appointments --}}
            <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600">
                Pay & Confirm Appointment
            </button>
        </form>
        <div class="mt-6">
            <h2 class="text-xl font-bold text-blue-700 mb-4">Payment Information</h2>
            <p class="text-gray-600">Please proceed to payment to confirm your appointment.</p>
            <ul class="list-disc list-inside mt-2">
                <li>Amount: <span id="amount_display">ETB 100</span></li>
                <li>Payment Method: Credit/Debit Card</li>
            </ul>
            <p class="mt-4">You will receive a confirmation email once the payment is processed.</p>
        </div>
    </div>
    <script>
        // Update the displayed amount dynamically
        document.getElementById('appointment_type').addEventListener('change', function () {
            const amountDisplay = document.getElementById('amount_display');
            const appointmentType = this.value;
            if (appointmentType === 'urgent') {
                amountDisplay.textContent = 'ETB 200';
            } else {
                amountDisplay.textContent = 'ETB 100';
            }
        });
    </script>
</body>
</html>