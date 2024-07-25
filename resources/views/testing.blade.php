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

<body class="font-body text-gray-900 antialiased">
    {{-- Content of the Login Interface --}}
    <div class="place-content-center min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 lg:bg-gradient-to-r from-cyan-500 to-blue-500">
        <div class="lg:flex flex-row w-full lg:max-w-4xl mt-6 lg:shadow-md overflow-hidden lg:rounded-box bg-base-100 p-6">

            {{-- Left Page --}}
            <div class="hidden lg:flex flex-col gap-4 bg-base-100 p-6 lg:w-1/2">
                <img src="{{ asset('assets/images/pilock-white.png') }}" class="self-center" style="max-width: 40%; max-height: 40%" alt="" srcset="">
                <h1 class="text-3xl font-bold self-center">Pi:Lock | Login</h1>
                <h1 class="text-md text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium explicabo neque corporis mollitia deserunt commodi laborum aliquam non eius, architecto praesentium labore, quod quisquam. Voluptas, nisi? Aliquam voluptas aliquid possimus.</h1>
                <h1 class="text-md text-justify">Developed by: Mark Glen Sadang Miguel</h1>
            </div>

            {{-- Right Pages --}}
            <div class="flex flex-col gap-4 bg-base-100 p-6 lg:w-1/2">
                {{-- Responsive Start --}}
                <img src="{{ asset('assets/images/pilock-white.png') }}" class="self-center lg:hidden" style="max-width: 30%; max-height: 30%" alt="" srcset="">
                <h1 class="text-3xl font-bold self-center lg:hidden">Pi:Lock | Login</h1>
                {{-- Responsive End --}}

                <h1 class="hidden lg:flex text-3xl font-bold self-center">Welcome Back!</h1>

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
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512" fill="white" stroke="currentColor" class="w-5 h-5">
                        <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
                    </svg>
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
