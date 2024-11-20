<div class="z-40 drawer-side" style="scroll-behavior: smooth; scroll-padding-top: 5rem;">
    <label for="drawer" class="drawer-overlay" aria-label="Close menu"></label>
    <aside class="w-64 h-full bg-base-100">

        <div class="sticky top-0 z-10 w-full px-2 py-3 bg-base-100 gap-y-2 bg-opacity-90 backdrop-blur lg:hidden">
            <a href="/" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost" data-svelte-h="svelte-nce89e">
                <img src="{{ asset('assets/images/pilock-white.png') }}" alt="" class="object-cover w-10 h-10 rounded">
                <span class="text-lg font-bold">{{ $appSetting->website_name ?? 'Pi:Lock | Faculty' }}</span>
            </a>
        </div>

        <div data-sveltekit-preload-data class="sticky top-0 z-20 items-center hidden gap-2 px-4 py-2 bg-base-100 bg-opacity-90 backdrop-blur lg:flex ">
            <!-- Drawer Logo -->
            <a wire:navigate.hover href="{{ route('archive.faculty.dashboard.index') }}" aria-current="page" aria-label="Homepage" class="px-2 flex-0 btn btn-ghost"
                data-svelte-h="svelte-nce89e">
                <img src="{{ asset('assets/images/pilock-white.png') }}" alt="" class="object-cover w-10 h-10 rounded">
                <span class="text-lg font-bold">{{ $appSetting->website_name ?? 'Pi:Lock | Faculty' }}</span>
            </a>
        </div>
        <div class="h-4"></div>

        {{-- Sidebar Content --}}
        <ul class="px-4 py-0 menu">
            <li class="mb-1 group {{ Request::is('archive/faculty/dashboard') ? 'active':'' }}">
                <a wire:navigate.hover href="{{ route('archive.faculty.dashboard.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-gauge"><path d="M15.6 2.7a10 10 0 1 0 5.7 5.7"/><circle cx="12" cy="12" r="2"/><path d="M13.4 10.6 19 5"/></svg>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>

            <li>
                <details id="disclosure-attendances">
                    <summary class="hover:bg-blue-400 hover:text-white {{ Request::is('archive/faculty/attendances') || Request::is('admin/attendances/*') || Request::is('archive/faculty/attendances/current') ? 'group bg-blue-700 text-white':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scroll-text"><path d="M15 12h-5"/><path d="M15 8h-5"/><path d="M19 17V5a2 2 0 0 0-2-2H4"/><path d="M8 21h12a2 2 0 0 0 2-2v-1a1 1 0 0 0-1-1H11a1 1 0 0 0-1 1v1a2 2 0 1 1-4 0V5a2 2 0 1 0-4 0v2a1 1 0 0 0 1 1h3"/></svg>
                        </span>Attendances
                    </summary>
                    <ul>
                        <li class="">
                            <a wire:navigate.hover href="{{ route('archive.faculty.attendances.index') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                All Attendances
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li class="mb-1 group {{ Request::is('archive/faculty/events') ? 'active':'' }}">
                <a wire:navigate.hover href="{{ route('archive.faculty.events.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-days"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
                    <span class="text-sm">Events</span>
                </a>
            </li>

            <li>
                <details id="disclosure-courses">
                    <summary class="hover:bg-blue-400 hover:text-white {{ Request::is('archive/faculty/courses') || Request::is('archive/faculty/courses/blockedstudents') ? 'group bg-blue-700 text-white':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></svg>
                        </span>Courses
                    </summary>
                    <ul>
                        <li class="">
                            <a wire:navigate.hover href="{{ route('archive.faculty.courses.index') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Your Courses
                            </a>
                        </li>
                        <li class="">
                            <a wire:navigate.hover href="{{ route('archive.faculty.courses.blocked') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Blocked Students
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li class="mb-1 group {{ Request::is('archive/faculty/students') ? 'active':'' }}">
                <a wire:navigate.hover href="{{ route('archive.faculty.students.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span class="text-sm">Students</span>
                </a>
            </li>

            <li>
                <details id="disclosure-schedules">
                    <summary class="hover:bg-blue-400 hover:text-white {{ Request::is('archive/faculty/schedules') || Request::is('archive/faculty/schedules/makeupscheds') ? 'group bg-blue-700 text-white':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-clock"><path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h5"/><path d="M17.5 17.5 16 16.3V14"/><circle cx="16" cy="16" r="6"/></svg>
                        </span>Schedules
                    </summary>
                    <ul>
                        <li class="">
                            <a wire:navigate.hover href="{{ route('archive.faculty.schedules.index') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Your Schedules
                            </a>
                        </li>
                        <li class="">
                            <a wire:navigate.hover href="{{ route('archive.faculty.schedules.makeup') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Make-Up Class Schedules
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li class="mb-1 group {{ Request::is('archive/faculty/seatplan') ? 'active':'' }}">
                <a wire:navigate.hover href="{{ route('archive.faculty.seatplan.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-armchair"><path d="M19 9V6a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v3"/><path d="M3 16a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V11a2 2 0 0 0-4 0z"/><path d="M5 18v2"/><path d="M19 18v2"/></svg>
                    <span class="text-sm">Seat Plan</span>
                </a>
            </li>

            <li class="mb-1 group {{ Request::is('archive/faculty/settings') ? 'active':'' }}">
                <a wire:navigate.hover href="{{ route('archive.faculty.settings.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span class="text-sm">Settings</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
