<div class="drawer-side z-40" style="scroll-behavior: smooth; scroll-padding-top: 5rem;">
    <label for="drawer" class="drawer-overlay" aria-label="Close menu"></label>
    <aside class="bg-base-100 w-64 h-full">

        <div class="bg-base-100 sticky top-0 z-10 w-full gap-y-2 bg-opacity-90 px-2 py-3 backdrop-blur lg:hidden">
            <a href="/" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost" data-svelte-h="svelte-nce89e">
                <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded object-cover">
                <span class="text-lg font-bold ml-3">{{ $appSetting->website_name ?? 'Pi:Lock | Student' }}</span>
            </a>
        </div>

        <div data-sveltekit-preload-data class="bg-base-100 sticky top-0 z-20 hidden items-center gap-2 bg-opacity-90 px-4 py-2 backdrop-blur lg:flex ">
            <!-- Drawer Logo -->
            <a href="{{ route('user.dashboard.index') }}" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost px-2"
                data-svelte-h="svelte-nce89e">
                <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded object-cover">
                <span class="text-lg font-bold ml-3">{{ $appSetting->website_name ?? 'Pi:Lock | Student' }}</span>
            </a>
        </div>
        <div class="h-4"></div>
        {{-- Sidebar Content --}}
        <ul class="menu px-4 py-0">
            <li class="mb-1 group {{ Request::is('dashboard') ? 'active':'' }}">
                <a href="{{ route('user.dashboard.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>

            {{-- @can('View Schedules') --}}
            <li>
                <details id="disclosure-schedules">
                    <summary class="hover:bg-blue-400 hover:text-white {{ Request::is('instructor/schedules') || Request::is('instructor/makeupscheds') ? 'group bg-blue-700 text-white':'' }}">
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
                                Regular Schedules
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
            {{-- @endcan --}}

            <li class="mb-1 group {{ Request::is('settings') ? 'active':'' }}">
                <a href="{{ route('user.settings.index') }}"
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
