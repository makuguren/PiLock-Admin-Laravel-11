<div class="drawer-side z-40" style="scroll-behavior: smooth; scroll-padding-top: 5rem;">
    <label for="drawer" class="drawer-overlay" aria-label="Close menu"></label>
    <aside class="bg-base-100 w-64 h-full">

        <div class="bg-base-100 sticky top-0 z-10 w-full gap-y-2 bg-opacity-90 px-2 py-3 backdrop-blur lg:hidden">
            <a href="/" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost" data-svelte-h="svelte-nce89e">
                <img src="{{ asset('assets/images/pilock-white.png') }}" alt="" class="w-10 h-10 rounded object-cover">
                <span class="text-lg font-bold">{{ $appSetting->website_name ?? 'Pi:Lock | Admin' }}</span>
            </a>
        </div>

        <div data-sveltekit-preload-data class="bg-base-100 sticky top-0 z-20 hidden items-center gap-2 bg-opacity-90 px-4 py-2 backdrop-blur lg:flex ">
            <!-- Drawer Logo -->
            <a href="{{ route('admin.dashboard.index') }}" aria-current="page" aria-label="Homepage" class="flex-0 btn btn-ghost px-2"
                data-svelte-h="svelte-nce89e">
                <img src="{{ asset('assets/images/pilock-white.png') }}" alt="" class="w-10 h-10 rounded object-cover">
                <span class="text-lg font-bold">{{ $appSetting->website_name ?? 'Pi:Lock | Admin' }}</span>
            </a>
        </div>
        <div class="h-4"></div>
        {{-- Sidebar Content --}}
        <ul class="menu px-4 py-0">
            @can('View Dashboard')
            <li class="mb-1 group {{ Request::is('admin/dashboard') ? 'active':'' }}">
                <a href="{{ route('admin.dashboard.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-gauge"><path d="M15.6 2.7a10 10 0 1 0 5.7 5.7"/><circle cx="12" cy="12" r="2"/><path d="M13.4 10.6 19 5"/></svg>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>
            @endcan

            @can('View RFID Checker')
            <li class="mb-1 group {{ Request::is('admin/rfidchecker') ? 'active':'' }}">
                <a href="{{ route('admin.rfidchecker.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-id-card"><path d="M16 10h2"/><path d="M16 14h2"/><path d="M6.17 15a3 3 0 0 1 5.66 0"/><circle cx="9" cy="11" r="2"/><rect x="2" y="5" width="20" height="14" rx="2"/></svg>
                    <span class="text-sm">RFID Checker</span>
                </a>
            </li>
            @endcan

            @can('View Analytics')
            <li class="mb-1 group {{ Request::is('admin/analytics') ? 'active':'' }}">
                <a href="{{ route('admin.analytics.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-column-stacked"><path d="M11 13H7"/><path d="M19 9h-4"/><path d="M3 3v16a2 2 0 0 0 2 2h16"/><rect x="15" y="5" width="4" height="12" rx="1"/><rect x="7" y="8" width="4" height="9" rx="1"/></svg>
                    <span class="text-sm">Analytics</span>
                </a>
            </li>
            @endcan

            {{-- @can('View Attendances')
            <li>
                <details id="disclosure-attendances">
                    <summary class="hover:bg-blue-400 hover:text-white {{ Request::is('admin/attendances') || Request::is('admin/attendances/*') ? 'group bg-blue-700 text-white':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        </span>Attendances
                    </summary>
                    <ul>
                        @can('View Current Attendances')
                        <li class="">
                            <a href="{{ route('admin.attendances.current') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Current Attendance
                            </a>
                        </li>
                        @endcan
                        <li class="">
                            <a href="{{ route('admin.attendances.index') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                All Attendances
                            </a>
                        </li>
                    </ul>
                </details>
            </li>
            @endcan --}}




            @can('View Sections')
            <li class="mb-1 group {{ Request::is('admin/sections') ? 'active':'' }}">
                <a href="{{ route('admin.sections.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></svg>
                    <span class="text-sm">Sections</span>
                </a>
            </li>
            @endcan

            @can('View Courses')
            <li class="mb-1 group {{ Request::is('admin/courses') ? 'active':'' }}">
                <a href="{{ route('admin.courses.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></svg>
                    <span class="text-sm">Courses</span>
                </a>
            </li>
            @endcan

            @can('View Students')
            <li>
                <details id="disclosure-students">
                    <summary class="hover:bg-blue-400 hover:text-white {{ Request::is('admin/students') || Request::is('admin/students/*') ? 'group bg-blue-700 text-white':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </span>Students
                    </summary>
                    <ul>
                        <li class="">
                            <a href="{{ route('admin.students.index') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Students List
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.students.create') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Add Student
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.students.addtaguid') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Add Tag UID
                            </a>
                        </li>
                    </ul>
                </details>
            </li>
            @endcan

            @can('View Instructors')
            <li>
                <details id="disclosure-instructors">
                    <summary class="hover:bg-blue-400 hover:text-white {{ Request::is('admin/instructors') || Request::is('admin/instructors/*') ? 'group bg-blue-700 text-white':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </span>Instructors
                    </summary>
                    <ul>
                        <li class="">
                            <a href="{{ route('admin.instructors.index') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Instructors List
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.instructors.addtaguid') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Add Tag UID
                            </a>
                        </li>
                    </ul>
                </details>
            </li>
            @endcan

            @can('View Events')
            <li class="mb-1 group {{ Request::is('admin/events') ? 'active':'' }}">
                <a href="{{ route('admin.events.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-days"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
                    <span class="text-sm">Events</span>
                </a>
            </li>
            @endcan

            @can('View Regular Schedules')
            <li>
                <details id="disclosure-schedules">
                    <summary class="hover:bg-blue-400 hover:text-white {{ Request::is('admin/schedules') || Request::is('admin/schedules/makeupscheds') || Request::is('admin/schedules/makeupapprovals') ? 'group bg-blue-700 text-white':'' }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-clock"><path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h5"/><path d="M17.5 17.5 16 16.3V14"/><circle cx="16" cy="16" r="6"/></svg>
                        </span>Schedules
                    </summary>
                    <ul>
                        <li class="">
                            <a href="{{ route('admin.schedules.index') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Regular Schedules
                            </a>
                        </li>
                        @can('View Make-Up Schedules')
                        <li class="">
                            <a href="{{ route('admin.schedules.makeup') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Make-Up Class Schedules
                            </a>
                        </li>
                        @endcan
                        @can('View Make-Up SchedApprovals')
                        <li class="">
                            <a href="{{ route('admin.schedules.approvals') }}"
                                class="group text-sm flex items-center hover:text-blue-700 before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                                Make-Up Approvals
                            </a>
                        </li>
                        @endcan
                    </ul>
                </details>
            </li>
            @endcan

            @can('View Admins')
            <li class="mb-1 group {{ Request::is('admin/admins') || Request::is('admin/admins/*') ? 'active':'' }}">
                <a href="{{ route('admin.admins.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span class="text-sm">Admins</span>
                </a>
            </li>
            @endcan

            @can('View Roles')
            <li class="mb-1 group {{ Request::is('admin/roles') || Request::is('admin/roles/*') ? 'active':'' }}">
                <a href="{{ route('admin.roles.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-crown"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></svg>
                    <span class="text-sm">Roles</span>
                </a>
            </li>
            @endcan

            @can('View Permissions')
            <li class="mb-1 group {{ Request::is('admin/permissions') ? 'active':'' }}">
                <a href="{{ route('admin.permissions.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-key-square"><path d="M12.4 2.7a2.5 2.5 0 0 1 3.4 0l5.5 5.5a2.5 2.5 0 0 1 0 3.4l-3.7 3.7a2.5 2.5 0 0 1-3.4 0L8.7 9.8a2.5 2.5 0 0 1 0-3.4z"/><path d="m14 7 3 3"/><path d="m9.4 10.6-6.814 6.814A2 2 0 0 0 2 18.828V21a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h.172a2 2 0 0 0 1.414-.586l.814-.814"/></svg>
                    <span class="text-sm">Permissions</span>
                </a>
            </li>
            @endcan

            @can('View Logs')
            <li class="mb-1 group {{ Request::is('admin/logs') ? 'active':'' }}">
                <a href="{{ route('admin.logs.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-down"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/><path d="M12 10v6"/><path d="m15 13-3 3-3-3"/></svg>
                    <span class="text-sm">Logs</span>
                </a>
            </li>
            @endcan

            @can('View Settings')
            <li class="mb-1 group {{ Request::is('admin/settings') ? 'active':'' }}">
                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center py-2 px-4 hover:bg-blue-400 hover:text-white rounded-md group-[.active]:bg-blue-700 group-[.active]:text-white group-[.selected]:bg-blue-700 group-[.selected]:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span class="text-sm">Settings</span>
                </a>
            </li>
            @endcan
        </ul>
    </aside>
</div>
