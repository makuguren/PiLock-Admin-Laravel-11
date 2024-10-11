<!DOCTYPE html>
<html data-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/pilock-dark.png') }}">
    <title>Pi:Lock System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,700,0,0" />
</head>

<style>
#body {
  background-color: rgb(29 78 216);
}
.box {
  position: fixed;
  top: 0;
  transform: rotate(60deg);
  right: 0;
}

.wave {
  position: absolute;
  opacity: .4;
  width: 1500px;
  height: 1300px;
  margin-left: -150px;
  margin-top: -250px;
  border-radius: 43%;
}

@keyframes rotate {
  from {transform: rotate(0deg);}
  from {transform: rotate(360deg);}
}

.wave.-one {
  animation: rotate 10000ms infinite linear;
  opacity: 5%;
  background: white;
}

.wave.-two {
  animation: rotate 6000ms infinite linear;
  opacity: 10%;
  background: white;
}
</style>

<body class="font-body">

    <div class='box'>
        <div class='wave -one'> </div>
        <div class='wave -two'></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar sticky top-0 justify-between bg-base-100">
        <!-- Logo -->
        <a class="btn btn-ghost text-lg font-bold">
            <img alt="Logo" src="{{ asset('assets/images/pilock-white.png') }}" class="w-10" />
            Pi:Lock System
        </a>

        <!-- Menu for mobile -->
        <div class="dropdown dropdown-end sm:hidden">
            <button class="btn btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
            </button>

            <ul tabindex="0" class="dropdown-content menu z-[1] bg-base-200 p-4 rounded-box shadow w-64 gap-2">
                @auth('admin')
                    <li><a href="{{ route('admin.dashboard.index') }}">Admin Dashboard</a></li>
                @else
                    <li><a href="{{ route('admin.login') }}">Admin Login</a></li>
                @endauth

                @auth('instructor')
                    <li><a href="{{ route('instructor.dashboard.index') }}">Instructor Dashboard</a></li>
                @else
                    <li><a href="{{ route('instructor.login') }}">Instructor Login</a></li>
                @endauth

                @auth('web')
                    <li><a href="{{ route('user.dashboard.index') }}">Student Dashboard</a></li>
                @else
                    <li><a href="{{ route('user.login') }}">Student Login</a></li>
                @endauth
            </ul>
        </div>

        <!-- Menu for desktop -->
        {{-- <ul class="hidden menu sm:menu-horizontal gap-2">
            <li><a>Home</a></li>
            <li><a>About</a></li>
            <li><a>Members</a></li>
            <li><a>Blog</a></li>
            <li><a>Contact</a></li>
        </ul> --}}

        <!-- Menu for desktop -->
        <div class="hidden sm:flex gap-2 mr-2">
            <!-- Dropdown menu -->
            @if ($appSetting->isRegLoginStud == '1' || $appSetting->isRegInst == '1' || $appSetting->isRegAdmins == '1')
                <div class="dropdown dropdown-end">
                    <button class="btn btn-ghost btn-sm text-white bg-blue-700 hover:bg-blue-500">
                        <span class="material-symbols-outlined">how_to_reg</span>
                        Register
                        {{-- <i class="fa-solid fa-chevron-down"></i> --}}
                    </button>

                    <ul tabindex="0" class="dropdown-content menu z-[1] bg-base-200 p-2 rounded-box shadow w-56 gap-2">
                        @if (Route::has('admin.register'))
                            <li><a href="{{ route('admin.register') }}">Admin Register</a></li>
                        @endif

                        @if (Route::has('instructor.register'))
                            <li><a href="{{ route('instructor.register') }}">Instructor Register</a></li>
                        @endif

                        @if (Route::has('user.register'))
                            <li><a href="{{ route('user.register') }}">Student Register</a></li>
                        @endif
                    </ul>
                </div>
            @endif

            <!-- Dropdown menu -->
            <div class="dropdown dropdown-end">
                <button class="btn btn-ghost btn-sm text-white bg-blue-700 hover:bg-blue-500">
                    <span class="material-symbols-outlined">Login</span>
                    Login
                    {{-- <i class="fa-solid fa-chevron-down"></i> --}}
                </button>

                <ul tabindex="0" class="dropdown-content menu z-[1] bg-base-200 p-2 rounded-box shadow w-56 gap-2">
                    @auth('admin')
                        <li><a href="{{ route('admin.dashboard.index') }}">Admin Dashboard</a></li>
                    @else
                        <li><a href="{{ route('admin.login') }}">Admin Login</a></li>
                    @endauth

                    @auth('instructor')
                        <li><a href="{{ route('instructor.dashboard.index') }}">Instructor Dashboard</a></li>
                    @else
                        <li><a href="{{ route('instructor.login') }}">Instructor Login</a></li>
                    @endauth

                    @auth('web')
                        <li><a href="{{ route('user.dashboard.index') }}">Student Dashboard</a></li>
                    @else
                        <li><a href="{{ route('user.login') }}">Student Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <section class="flex flex-col lg:flex-row justify-center gap-10 h-screen p-4" id="body">
        <!-- Text Content -->
        <div class="flex flex-col justify-center items-start gap-6 text-white text-justify lg:w-1/2 lg:items-left">
            <h1 class="text-3xl lg:text-5xl font-bold">Pi:Lock System</h1>

            <p class="text-base lg:text-lg">
                Welcome to Pi:Lock System – your ultimate solution for secure, automated door locking. Our system leverages the power of Raspberry Pi and Laravel 11 to offer seamless schedule-based authentication, ensuring your spaces are protected and accessible only at the right times. Experience the future of security with Pi:Lock System.
            </p>

            <!-- Uncomment this section if needed -->
            {{-- <div class="flex flex-col lg:flex-row gap-4">
                <a class="btn btn-ghost bg-green-700 hover:bg-green-500 text-white px-4 py-2 rounded">
                    Get started
                    <i class="fa-solid fa-arrow-right text-sm"></i>
                </a>

                <a class="btn btn-ghost bg-neutral-700 hover:bg-neutral-500 text-white px-4 py-2 rounded">
                    See our blog
                    <i class="fa-solid fa-blog"></i>
                </a>
            </div> --}}
        </div>

        <!-- Image -->
        <div class="flex flex-col justify-center items-center lg:w-1/3">
            <img src="{{ asset('assets/images/pilock-dark.png') }}" alt="Pi:Lock System" class="w-full h-auto max-w-md">
        </div>
    </section>


    <section class="bg-base-100 p-10">
        <div class="flex flex-col items-center gap-8">
            <h1 class="font-bold text-4xl self-center">Meet the Members</h1>

            <!-- Team -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-20">
                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="{{ asset('assets/images/members/mayor.jpg') }}" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Mark Glen S. Miguel</h3>

                        <!-- Role -->
                        <span class="text-sm">Programmer, UI Designer, Database Designer - D'Logics</span>

                        <!-- Socials -->
                        {{-- <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>

                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="{{ asset('assets/images/members/fulledo.jpg') }}" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Mark Angelo S. Fulledo</h3>

                        <!-- Role -->
                        <span class="text-sm">Project Head, QA Tester - D'Logics</span>

                        <!-- Socials -->
                        {{-- <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>

                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="{{ asset('assets/images/members/sombrero.jpeg') }}" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Anne Nicole A. Sombrero</h3>

                        <!-- Role -->
                        <span class="text-sm">Documentation Writer, Database Designer - D'Logics</span>

                        <!-- Socials -->
                        {{-- <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>

                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="{{ asset('assets/images/members/eloisa.jpg') }}" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Eloisa A. Celaje</h3>

                        <!-- Role -->
                        <span class="text-sm">Document Writer, UI Designer - D'Logics</span>

                        <!-- Socials -->
                        {{-- <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>

                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="{{ asset('assets/images/members/larry.png') }}" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Lary C. Sain</h3>

                        <!-- Role -->
                        <span class="text-sm">Programmer, Database Designer, UI Designer - Team-BA</span>

                        <!-- Socials -->
                        {{-- <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>

                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="{{ asset('assets/images/members/baltazar.jpg') }}" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Alfred Joseph T. Baltazar</h3>

                        <!-- Role -->
                        <span class="text-sm">Project Head, Database Designer, Programmer - Team-BA</span>

                        <!-- Socials -->
                        {{-- <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>

                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="{{ asset('assets/images/members/neverio.jpg') }}" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Jovita Z. Neverio</h3>

                        <!-- Role -->
                        <span class="text-sm">UI Designer, Documentation, Writer - Team-BA</span>

                        <!-- Socials -->
                        {{-- <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="flex flex-col sm:flex-row gap-8 justify-between p-10 bg-base-200">

        <!-- Brand -->
        <aside>
            <p class="text-3xl flex items-center gap-2 font-bold">
                <img alt="Logo" src="{{ asset('assets/images/pilock-white.png') }}" class="inline w-12" />
                Pi:Lock System
            </p>
            <small>Copyright © 2024 - All rights reserved</small>
        </aside>

        <!-- Socials -->
        <nav class="flex gap-4">
            <a class="btn btn-ghost btn-sm btn-circle">
                <i class="fa-brands fa-github text-2xl"></i>
            </a>
            <a class="btn btn-ghost btn-sm btn-circle">
                <i class="fa-brands fa-twitter text-2xl"></i>
            </a>
            <a class="btn btn-ghost btn-sm btn-circle">
                <i class="fa-brands fa-facebook text-2xl"></i>
            </a>
            <a class="btn btn-ghost btn-sm btn-circle">
                <i class="fa-brands fa-youtube text-2xl"></i>
            </a>
        </nav>
    </footer>
</body>
</html>
