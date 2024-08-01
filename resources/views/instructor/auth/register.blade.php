<x-instructor-guest-layout>

    <x-slot:title>Register</x-slot:title>

    {{-- Left Page --}}
    <div class="hidden lg:flex flex-col gap-4 bg-base-100 p-6 justify-center lg:w-1/2">
        <img src="{{ asset('assets/images/pilock-white.png') }}" class="self-center" style="max-width: 40%; max-height: 40%" alt="" srcset="">
        <h1 class="text-3xl font-bold self-center">Pi:Lock | Instructor Register</h1>
        <h1 class="text-md text-justify">Welcome to Pi:Lock System – your ultimate solution for secure, automated door locking. Our system leverages the power of Raspberry Pi and Laravel 11 to offer seamless schedule-based authentication, ensuring your spaces are protected and accessible only at the right times. Experience the future of security with Pi:Lock System.</h1>
        <h1 class="text-md text-justify">Capstone Group by: D'Logics & Team-BA</h1>
    </div>

    {{-- Right Pages --}}
    <div class="flex flex-col gap-4 bg-base-100 p-6 justify-center lg:w-1/2">
        {{-- Responsive Start --}}
        <img src="{{ asset('assets/images/pilock-white.png') }}" class="self-center lg:hidden" style="max-width: 30%; max-height: 30%" alt="" srcset="">
        <h1 class="text-3xl font-bold self-center lg:hidden">Pi:Lock | Instructor Register</h1>
        {{-- Responsive End --}}

        <h1 class="hidden lg:flex text-3xl font-bold self-center">Welcome Back!</h1>

        <form method="POST" action="{{ route('instructor.register') }}">
            @csrf
            <label for="name" class="form-control mb-4">
                <div class="label">
                    <span class="label-text">Name</span>
                </div>
                <input class="input input-bordered" type="name" id="name" name="name" value="{{ old('name') }}" required autofocus complete="username" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </label>

            <label for="email" class="form-control mb-4">
                <div class="label">
                    <span class="label-text">Email</span>
                </div>
                <input class="input input-bordered" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus complete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </label>

            <label for="password" class="form-control mb-4">
                <div class="label">
                    <span class="label-text">Password</span>
                </div>

                <input class="input input-bordered" name="password" id="password" type="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </label>

            <label for="password_confirmation" class="form-control mb-4">
                <div class="label">
                    <span class="label-text">Confirm Password</span>
                </div>

                <input class="input input-bordered" name="password_confirmation" id="password_confirmation" type="password" required autocomplete="password-confirmation" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </label>

            <button type="submit" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 text-white w-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" stroke="currentColor" class="w-5 h-5" viewBox="0 0 512 512">
                    <path d="M217.9 105.9L340.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L217.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1L32 320c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM352 416l64 0c17.7 0 32-14.3 32-32l0-256c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c53 0 96 43 96 96l0 256c0 53-43 96-96 96l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32z"/>
                </svg>
                Register
            </button>

            {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('user.login') }}">
                {{ __('Already registered?') }}
            </a> --}}
        </form>
    </div>
</x-instructor-guest-layout>
