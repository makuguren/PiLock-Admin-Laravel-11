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
                <i class="fa-solid fa-bars text-lg"></i>
            </button>

            <ul tabindex="0" class="dropdown-content menu z-[1] bg-base-200 p-4 rounded-box shadow w-64 gap-2">
                <li><a>About</a></li>
                <li><a>Team</a></li>
                <li>
                    <h2 class="menu-title">Features</h2>
                    <ul>
                        <li><a>Tech tools</a></li>
                        <li><a>Podcast</a></li>
                        <li><a>Community</a></li>
                    </ul>
                </li>
                <a class="btn btn-ghost btn-primary btn-sm">
                    <i class="fa-solid fa-rocket"></i>
                    Access
                </a>
            </ul>
        </div>

        <!-- Menu for desktop -->
        <ul class="hidden menu sm:menu-horizontal gap-2">
            <li><a>Home</a></li>
            <li><a>About</a></li>
            <li><a>Members</a></li>
            <li><a>Blog</a></li>
            <li><a>Contact</a></li>
        </ul>

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

    <section class="lg:flex lg:flex-row justify-center gap-10 h-screen" id="body">
        <div class="flex flex-col place-content-center items-left gap-6 text-white text-justify lg:w-1/2">
            <h1 class="text-5xl font-bold">Pi:Lock System</h1>

            <span class="">
                Welcome to Pi:Lock System – your ultimate solution for secure, automated door locking. Our system leverages the power of Raspberry Pi and Laravel 11 to offer seamless schedule-based authentication, ensuring your spaces are protected and accessible only at the right times. Experience the future of security with Pi:Lock System.
            </span>

            {{-- <div class="flex gap-4">
                <a class="btn btn-ghost bg-green-700 hover:bg-green-500 text-white">
                    Get started
                    <i class="fa-solid fa-arrow-right text-sm"></i>
                </a>

                <a class="btn btn-ghost btn-neutral">
                    See our blog
                    <i class="fa-solid fa-blog"></i>
                </a>
            </div> --}}
        </div>

        <div class="flex flex-col lg:place-content-center items-center lg:w-1/3">
            <img src="{{ asset('assets/images/pilock-dark.png') }}" style="max-width: 100%; max-height: 100%" srcset="">
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
                    <img alt="Logo" src="/avatar.png" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Mark Glen Miguel</h3>

                        <!-- Role -->
                        <span class="text-sm">Programmer - D'Logics</span>

                        <!-- Socials -->
                        <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="/avatar.png" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Mark Angelo Fulledo</h3>

                        <!-- Role -->
                        <span class="text-sm">Project Head - D'Logics</span>

                        <!-- Socials -->
                        <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="/avatar.png" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Anne Nicole Sombrero</h3>

                        <!-- Role -->
                        <span class="text-sm">Document / Database Designer - D'Logics</span>

                        <!-- Socials -->
                        <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="/avatar.png" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Eloisa Celaje</h3>

                        <!-- Role -->
                        <span class="text-sm">Document / UI Designer - D'Logics</span>

                        <!-- Socials -->
                        <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="/avatar.png" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Larry Sain</h3>

                        <!-- Role -->
                        <span class="text-sm">Pancit Canton Chef - Team-BA</span>

                        <!-- Socials -->
                        <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="/avatar.png" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Alfred Joseph Baltazar</h3>

                        <!-- Role -->
                        <span class="text-sm">Project Head / Programmer - Team-BA</span>

                        <!-- Socials -->
                        <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Member -->
                <div class="flex gap-4">
                    <!-- Photo -->
                    <img alt="Logo" src="/avatar.png" class="rounded-full w-24" />

                    <div class="flex flex-col gap-2">
                        <!-- Name -->
                        <h3 class="font-bold">Jovita Neverio</h3>

                        <!-- Role -->
                        <span class="text-sm">Document - Team-BA</span>

                        <!-- Socials -->
                        <div class="flex text-accent text-xs">
                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-github text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-twitter text-lg"></i>
                            </a>

                            <a class="btn btn-ghost btn-sm btn-circle">
                                <i class="fa-brands fa-facebook text-lg"></i>
                            </a>
                        </div>
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
