<!doctype html>
<html data-theme="{{ $appSetting->theme ?? 'light' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/pilock-dark.png') }}">
    <title>{{ $title ?? '' }} - Pi:Lock | Faculty</title>

    <!-- Link for cdn -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased font-body">
    {{-- Content of the Login Interface --}}
    <div class="flex flex-col items-center min-h-screen pt-6 place-content-center sm:justify-center sm:pt-0 lg:bg-gradient-to-r from-cyan-500 to-blue-500">
        <div class="flex-row w-full p-6 mt-6 overflow-hidden lg:flex lg:max-w-4xl lg:shadow-md lg:rounded-box bg-base-100">
            {{ $slot }}
        </div>
    </div>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- @vite('resources/js/script.js') --}}

    @livewireScripts
</body>

</html>
