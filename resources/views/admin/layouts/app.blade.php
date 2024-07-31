<!DOCTYPE html>
<html data-theme="{{ Auth::user()->admin_theme ?? 'light' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/pilock-dark.png') }}">
    <title> {{ $title ?? '' }} - {{ $appSetting->website_name ?? 'Pi:Lock | Admin' }} </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-body">
    <div class="drawer lg:drawer-open">
        <input id="drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content bg-base-200">
            <!-- Navbar -->
            @include('admin.layouts.includes.navbar')

            <!-- Page content here -->
            {{ $slot }}
        </div>

        {{-- Sidebar --}}
        @include('admin.layouts.includes.sidebar')
    </div>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    {{-- <script src="{{ asset('assets/js/chart.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    {{-- Calendar CDN --}}
    <script src="{{ asset('assets/js/calendar/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/calendar/fullcalendar.css') }}" />
    <script src="{{ asset('assets/js/calendar/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/calendar/fullcalendar.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    {{-- End Calendar CDN --}}

    {{-- @vite('resources/js/script.js') --}}

    {{ $scripts ?? '' }}

    @livewireScripts
    @livewireCalendarScripts
</body>

</html>
