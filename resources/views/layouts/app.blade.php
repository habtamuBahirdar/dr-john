<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deshet Indigenous Medical Center</title>
    @vite('resources/css/app.css') {{-- Tailwind via Vite --}}
</head>
<body class="bg-gray-100 text-gray-900">

    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-y-auto">
            {{-- Header --}}
            @include('layouts.header')

            {{-- Main Content --}}
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
