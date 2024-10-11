<div class="drawer-side z-40" style="scroll-behavior: smooth; scroll-padding-top: 5rem;">
    <label for="drawer" class="drawer-overlay" aria-label="Close menu"></label>
    <aside class="bg-base-100 w-64 h-full">

        <div class="bg-base-100 sticky top-0 z-10 w-full gap-y-2 bg-opacity-90 px-2 py-3 backdrop-blur lg:hidden">
            <a wire:navigate.hover href="{{ route('user.dashboard.index') }}" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost" data-svelte-h="svelte-nce89e">
                <img src="{{ asset('assets/images/pilock-white.png') }}" alt="" class="w-10 h-10 rounded object-cover">
                <span class="text-lg font-bold">{{ $appSetting->website_name ?? 'Pi:Lock | Student' }}</span>
            </a>
        </div>

        <div data-sveltekit-preload-data class="bg-base-100 sticky top-0 z-20 hidden items-center gap-2 bg-opacity-90 px-4 py-2 backdrop-blur lg:flex ">
            <!-- Drawer Logo -->
            <a wire:navigate.hover href="{{ route('user.dashboard.index') }}" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost px-2"
                data-svelte-h="svelte-nce89e">
                <img src="{{ asset('assets/images/pilock-white.png') }}" alt="" class="w-10 h-10 rounded object-cover">
                <span class="text-lg font-bold">{{ $appSetting->website_name ?? 'Pi:Lock | Student' }}</span>
            </a>
        </div>
        <div class="h-4"></div>
        {{-- Sidebar Content --}}
        <ul class="menu px-4 py-0">
            <li class="mb-1 group {{ Request::is('dashboard') ? 'active':'' }}">
                <a wire:navigate.hover href="{{ route('user.dashboard.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-gauge"><path d="M15.6 2.7a10 10 0 1 0 5.7 5.7"/><circle cx="12" cy="12" r="2"/><path d="M13.4 10.6 19 5"/></svg>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>

            <li class="mb-1 group {{ Request::is('schedules') ? 'active':'' }}">
                <a wire:navigate.hover href="{{ route('user.schedules.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-clock"><path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h5"/><path d="M17.5 17.5 16 16.3V14"/><circle cx="16" cy="16" r="6"/></svg>
                    <span class="text-sm">Schedules</span>
                </a>
            </li>

            <li>
                <details id="disclosure-courses">
                    <summary class="hover:bg-blue-400 hover:text-white {{ Request::is('courses') || Request::is('courses/enrolledcourses') ? 'group bg-blue-700 text-white':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></svg>
                        </span>Courses
                    </summary>
                    <ul>
                        <li class="">
                            <a wire:navigate.hover href="{{ route('user.courses.enrolled') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Enrolled Courses
                            </a>
                        </li>
                        <li class="">
                            <a wire:navigate.hover href="{{ route('user.courses.index') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                All Courses
                            </a>
                        </li>
                    </ul>
                </details>
            </li>
            {{-- @endcan --}}

            <li class="mb-1 group {{ Request::is('settings') ? 'active':'' }}">
                <a wire:navigate.hover href="{{ route('user.settings.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span class="text-sm">Settings</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
