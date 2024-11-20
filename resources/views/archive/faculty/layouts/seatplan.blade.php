<!DOCTYPE html>
<html data-theme="{{ Auth::user()->faculty_theme ?? 'light' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/pilock-dark.png') }}">
    <title> {{ $title ?? '' }} - {{ $appSetting->website_name ?? 'Pi:Lock | Faculty' }} </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-body">
    <div class="drawer lg:drawer-open">
        <input id="drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content bg-base-200">
            <!-- Navbar -->
            <!-- Implement Code here for Header Body -->
            <nav class="sticky top-0 z-30 navbar bg-base-100">
                <div data-sveltekit-preload-data class="sticky top-0 z-20 items-center hidden gap-2 px-4 py-2 bg-base-100 bg-opacity-90 backdrop-blur lg:flex ">
                    <!-- Drawer Logo -->
                    <a href="{{ route('archive.faculty.dashboard.index') }}" aria-current="page" aria-label="Homepage" class="px-2 flex-0 btn btn-ghost"
                        data-svelte-h="svelte-nce89e">
                        <img src="{{ asset('assets/images/pilock-white.png') }}" alt="" class="object-cover w-10 h-10 rounded">
                        <span class="text-lg font-bold">{{ $appSetting->website_name ?? 'Pi:Lock | Faculty' }}</span>
                    </a>
                </div>

                <div class="flex-1">
                    <label aria-label="Open menu" for="drawer" class="btn btn-square btn-ghost drawer-button lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </label>
                </div>
                <div class="flex-none gap-1">
                    {{-- Notifications --}}
                    {{-- <button class="btn btn-ghost btn-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                        </svg>
                    </button> --}}

                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-ghost">
                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="stroke-current h-7 w-7">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z">
                                </path>
                            </svg>
                            <span class="hidden font-normal md:inline">Welcome! {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                            <svg width="12px" height="12px" class="hidden w-2 h-2 fill-current opacity-60 sm:inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2048 2048">
                                <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
                            </svg>
                        </div>
                        <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                            <li><a href="{{ route('archive.faculty.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('archive.faculty.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page content here -->
            {{ $slot }}
        </div>
    </div>

    {{-- <script src="https://unpkg.com/@popperjs/core@2"></script> --}}
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

    {{-- Fontawesome Icons --}}
    <script src="https://kit.fontawesome.com/89b7b6a046.js" crossorigin="anonymous"></script>
    {{-- @vite('resources/js/script.js') --}}

    @livewireScripts

    {{ $scripts ?? '' }}
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>

    @livewireCalendarScripts
</body>

</html>
