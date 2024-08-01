<!-- Implement Code here for Header Body -->
<nav class="navbar bg-base-100 sticky top-0 z-30">
    <div class="flex-1">
        <label aria-label="Open menu" for="drawer" class="btn btn-ghost btn-square btn-ghost drawer-button lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </label>
    </div>


    <div class="flex-none">
        {{-- Username with Dropdown --}}
        <div class="dropdown dropdown-end">
            <div tabindex="0" class="btn btn-ghost">
                <div role="button" class="avatar">
                    <div class="w-10 rounded">
                      <img
                        alt="Tailwind CSS Navbar component"
                        src="{{ Auth::user()->avatar }}" />
                    </div>
                </div>
                <span class="hidden font-medium md:inline">{{ Auth::user()->name }}</span>
                <svg width="12px" height="12px" class="hidden h-2 w-2 fill-current opacity-60 sm:inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2048 2048">
                    <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
                </svg>
            </div>

            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                <li><a href="{{ route('user.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
