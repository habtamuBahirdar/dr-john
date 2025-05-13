{{-- filepath: d:\My comany\dr-yohannes online schedule\dr-john\resources\views\patient\appointments\create.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make an Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .flatpickr-day.available {
            background-color: #38a169 !important; /* Green for available dates */
            color: white !important;
        }
        .flatpickr-day.unavailable {
            background-color: #a0aec0 !important; /* Dark gray for unavailable dates */
            color: white !important;
            pointer-events: none; /* Disable clicking */
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <pre>{{ print_r($availableDates) }}</pre>
        <h1 class="text-2xl font-bold text-blue-700 mb-6">Make an Appointment</h1>
        <form action="{{ route('appointments.pay') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="appointment_date" class="block text-gray-700 font-bold mb-2">Appointment Date</label>
                <input type="text" id="appointment_date" name="appointment_date" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
            </div>
            <div class="mb-4">
                <label for="appointment_time" class="block text-gray-700 font-bold mb-2">Appointment Time</label>
               <select id="appointment_time" name="appointment_time" required>
    <option value="" disabled selected>Select a time</option>
    @foreach ($groupedSchedules as $date => $schedules)
        @foreach ($schedules as $schedule)
           <option value="{{ $schedule->start_time }}" data-end="{{ $schedule->end_time }}" data-date="{{ $date }}">
    {{ $schedule->start_time }} - {{ $schedule->end_time }} ({{ ucfirst($schedule->session) }})
</option>

        @endforeach
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
    </div>

   <script>
    document.addEventListener('DOMContentLoaded', function () {
    const availableDates = @json($availableDates);

    function formatDate(date) {
        const year = date.getFullYear();
        const month = (`0${date.getMonth() + 1}`).slice(-2);
        const day = (`0${date.getDate()}`).slice(-2);
        return `${year}-${month}-${day}`;
    }

    flatpickr("#appointment_date", {
        dateFormat: "Y-m-d",
        disable: [
            function(date) {
                return !availableDates.includes(formatDate(date));
            }
        ],
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            const date = formatDate(dayElem.dateObj);
            if (availableDates.includes(date)) {
                dayElem.classList.add('available');
            } else {
                dayElem.classList.add('unavailable');
            }
        }
    });

    const dateInput = document.getElementById('appointment_date');
    const timeSelect = document.getElementById('appointment_time');

    dateInput.addEventListener('change', function () {
        const selectedDate = this.value;
        const options = timeSelect.querySelectorAll('option');

        options.forEach(option => {
            if (option.dataset.date === selectedDate) {
                option.style.display = 'block';
                option.disabled = false;
            } else {
                option.style.display = 'none';
                option.disabled = true;
            }
        });

        timeSelect.value = '';
    });
});

</script>

</body>
</html>