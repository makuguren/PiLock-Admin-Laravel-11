<div class="drawer-side z-40" style="scroll-behavior: smooth; scroll-padding-top: 5rem;">
    <label for="drawer" class="drawer-overlay" aria-label="Close menu"></label>
    <aside class="bg-base-100 w-64 h-full">

        <div class="bg-base-100 sticky top-0 z-10 w-full gap-y-2 bg-opacity-90 px-2 py-3 backdrop-blur lg:hidden">
            <a href="/" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost" data-svelte-h="svelte-nce89e">
                <img src="{{ asset('assets/images/pilock-white.png') }}" alt="" class="w-10 h-10 rounded object-cover">
                <span class="text-lg font-bold">{{ $appSetting->website_name ?? 'Pi:Lock | Instructor' }}</span>
            </a>
        </div>

        <div data-sveltekit-preload-data class="bg-base-100 sticky top-0 z-20 hidden items-center gap-2 bg-opacity-90 px-4 py-2 backdrop-blur lg:flex ">
            <!-- Drawer Logo -->
            <a href="{{ route('instructor.dashboard.index') }}" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost px-2"
                data-svelte-h="svelte-nce89e">
                <img src="{{ asset('assets/images/pilock-white.png') }}" alt="" class="w-10 h-10 rounded object-cover">
                <span class="text-lg font-bold">{{ $appSetting->website_name ?? 'Pi:Lock | Instructor' }}</span>
            </a>
        </div>
        <div class="h-4"></div>

        {{-- Sidebar Content --}}
        <ul class="menu px-4 py-0">
            <li class="mb-1 group {{ Request::is('instructor/dashboard') ? 'active':'' }}">
                <a href="{{ route('instructor.dashboard.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>

            <li>
                <details id="disclosure-attendances">
                    <summary class="hover:bg-blue-400 hover:text-white {{ Request::is('instructor/attendances') || Request::is('admin/attendances/*') || Request::is('instructor/attendances/current') ? 'group bg-blue-700 text-white':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        </span>Attendances
                    </summary>
                    <ul>
                        <li class="">
                            <a href="{{ route('instructor.attendances.current') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Current Attendance
                            </a>
                        </li>

                        <li class="">
                            <a href="{{ route('instructor.attendances.index') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                All Attendances
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li class="mb-1 group {{ Request::is('instructor/events') ? 'active':'' }}">
                <a href="{{ route('instructor.events.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                    <span class="text-sm">Events</span>
                </a>
            </li>

            <li>
                <details id="disclosure-schedules">
                    <summary class="hover:bg-blue-400 hover:text-white {{ Request::is('instructor/schedules') || Request::is('instructor/schedules/makeupscheds') ? 'group bg-blue-700 text-white':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </span>Schedules
                    </summary>
                    <ul>
                        <li class="">
                            <a href="{{ route('instructor.schedules.index') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Your Schedules
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('instructor.schedules.makeup') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Make-Up Class Schedules
                            </a>
                        </li>
                    </ul>
                </details>
            </li>

            <li class="mb-1 group {{ Request::is('instructor/seatplan') ? 'active':'' }}">
                <a href="{{ route('instructor.seatplan.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <span class="text-sm">Seat Plan</span>
                </a>
            </li>

            <li class="mb-1 group {{ Request::is('instructor/settings') ? 'active':'' }}">
                <a href="{{ route('instructor.settings.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="text-sm">Settings</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
