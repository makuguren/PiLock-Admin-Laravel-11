<!doctype html>
<html data-theme="{{ $appSetting->theme ?? 'light' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Hello World </title>

    <!-- Link for cdn -->
    {{-- <link href="{{ asset('resources/') }}" rel="stylesheet" type="text/css" /> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans text-gray-900 antialiased">
    {{-- Content of the Login Interface --}}
    <div class="place-content-center min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 lg:bg-gradient-to-r from-cyan-500 to-blue-500">
        <div class="w-full sm:max-w-md mt-6 lg:shadow-md overflow-hidden lg:rounded-box">

            <div class="flex flex-col gap-4 bg-base-100 p-6">
                <h1 class="text-3xl font-bold self-center">Log in</h1>

                <label class="form-control">
                    <div class="label">
                        <span class="label-text">Email</span>
                    </div>

                    <input class="input input-bordered" />
                </label>

                <label class="form-control">
                    <div class="label">
                        <span class="label-text">Password</span>
                        <a class="label-text link link-accent">Forgot password?</a>
                    </div>

                    <input type="password" class="input input-bordered" />
                </label>

                <div class="form-control">
                    <label class="cursor-pointer label self-start gap-2">
                        <input type="checkbox" class="checkbox" />
                        <span class="label-text">Remember me</span>
                    </label>
                </div>

                {{-- <span class="self-center">
                    Don't have an account?
                    <a class="link link-secondary">Register</a>
                </span> --}}

                <button class="btn bg-blue-700 hover:bg-blue-500 text-white">Log in</button>

                <div class="divider">OR</div>

                <a class="btn bg-red-700 hover:bg-red-500 text-white">
                    <i class="fa-brands fa-google text-primary"></i>
                    Log in with Google
                </a>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- @vite('resources/js/script.js') --}}

    @livewireScripts
</body>

</html>
