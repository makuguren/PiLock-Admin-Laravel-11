<!-- Implement Code here for Header Body -->
{{-- @include('admin.layouts.includes.logout') --}}
<nav class="sticky top-0 z-30 navbar bg-base-100">
    <div class="flex-1">
        <label aria-label="Open menu" for="drawer" class="btn btn-ghost btn-square drawer-button lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </label>
    </div>
    <div class="w-full p-3 bg-red-700 rounded-lg">
        <span class="font-bold text-white text-md">Archived Content: This page is read-only and cannot be modified. It is preserved for historical reference only.</span>
    </div>
    <div class="flex-none gap-1">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="10" r="3"/><path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"/></svg>
                <span class="hidden font-normal md:inline">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                <svg width="12px" height="12px" class="hidden w-2 h-2 fill-current opacity-60 sm:inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2048 2048">
                    <path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
                </svg>
            </div>
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                <li><a href="{{ route('archive.admin.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('archive.admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

                {{-- <li>
                    <label for="logout_modal">
                        Logout Modal
                    </label>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>
