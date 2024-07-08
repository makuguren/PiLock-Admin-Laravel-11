<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Dashboard</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Summary of Data in Every Pages</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Statistics</div>
                </div>

                <div class="lg:flex lg:flex-column lg:gap-5">
                    <div class="stats w-full shadow bg-gradient-to-r from-cyan-500 to-blue-500 mb-5">
                        <div class="stat">
                            <div class="stat-figure text-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"></path></svg>
                            </div>
                            <div class="stat-title text-gray-100">Students</div>
                            <div class="stat-value text-gray-100">{{ $totalStudents }}</div>
                            {{-- <div class="stat-desc">Jan 1st - Feb 1st</div> --}}
                            </div>
                    </div>

                    <div class="stats w-full shadow bg-gradient-to-r from-amber-500 to-pink-500 mb-5">
                        <div class="stat">
                            <div class="stat-figure text-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path></svg>
                            </div>
                            <div class="stat-title text-gray-100">Schedules</div>
                            <div class="stat-value text-gray-100">{{ $totalSchedules }}</div>
                            {{-- <div class="stat-desc">↗︎ 400 (22%)</div> --}}
                        </div>
                    </div>

                    <div class="stats w-full shadow bg-gradient-to-r from-fuchsia-600 to-pink-600 mb-5">
                        <div class="stat">
                            <div class="stat-figure text-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"></path></svg>
                            </div>
                            <div class="stat-title text-gray-100">Instructors</div>
                            <div class="stat-value text-gray-100">{{ $totalInstructors }}</div>
                            {{-- <div class="stat-desc">↘︎ 90 (14%)</div> --}}
                        </div>
                    </div>
                </div>

                <div class="lg:flex lg:flex-column lg:gap-5">
                    <div class="stats w-full shadow bg-gradient-to-r from-emerald-500 to-emerald-900 mb-5">
                        <div class="stat">
                            <div class="stat-figure text-gray-100">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776"></path></svg>
                            </div>
                            <div class="stat-title text-gray-100">Subjects</div>
                            <div class="stat-value text-gray-100">{{ $totalSubjects }}</div>
                            {{-- <div class="stat-desc">Jan 1st - Feb 1st</div> --}}
                        </div>
                    </div>

                    <div class="stats w-full shadow bg-gradient-to-r from-red-500 to-orange-500 mb-5">
                        <div class="stat">
                            <div class="stat-figure text-gray-100">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776"></path></svg>
                            </div>
                            <div class="stat-title text-gray-100">Sections</div>
                            <div class="stat-value text-gray-100">{{ $totalSections }}</div>
                            {{-- <div class="stat-desc">↗︎ 400 (22%)</div> --}}
                        </div>
                    </div>

                    <div class="stats w-full shadow bg-gradient-to-r from-emerald-400 to-cyan-400 mb-5">
                        <div class="stat">
                            <div class="stat-figure text-gray-100">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"></path></svg>
                            </div>
                            <div class="stat-title text-gray-100">Events</div>
                            <div class="stat-value text-gray-100">{{ $totalEvents }}</div>
                            {{-- <div class="stat-desc">↗︎ 400 (22%)</div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Device Usage</div>
                </div>
                @if ($systeminfo == null)
                    <div class="overflow-x-auto">
                        <div class="w-full mb-4">
                            <div class="flex items-center justify-between gap-4 mb-2">
                                <h6>No API Connect Found. Please Connect to the Server</h6>
                            </div>
                        </div>
                    </div>
                @else
                    <div wire:poll.1s class="overflow-x-auto">
                        {{-- Implement Code here! --}}
                        <div class="w-full mb-4">
                            <div class="flex items-center justify-between gap-4 mb-2">
                            <h6
                                class=" text-base block font-sans antialiased leading-relaxed tracking-normal text-blue-gray-900">
                                CPU Usage
                            </h6>
                            <h6
                                class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                                {{ $systeminfo['cpuUsage'] }}%
                            </h6>
                            </div>
                            <div
                            class="flex-start flex h-2.5 w-full overflow-hidden rounded-full bg-blue-gray-50 font-sans text-xs font-medium">
                            <progress class="progress progress-info w-100 h-full" value="{{ $systeminfo['cpuUsage'] }}" max="100"></progress>
                            </div>
                        </div>

                        <div class="w-full mb-4">
                            <div class="flex items-center justify-between gap-4 mb-2">
                            <h6
                                class=" text-base block font-sans antialiased leading-relaxed tracking-normal text-blue-gray-900">
                                RAM Usage
                            </h6>
                            <h6
                                class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                                {{ $systeminfo['usagePercentage'] }}%
                            </h6>
                            </div>
                            <div
                            class="flex-start flex h-2.5 w-full overflow-hidden rounded-full bg-blue-gray-50 font-sans text-xs font-medium">
                            <progress class="progress progress-info w-100 h-full" value="{{ $systeminfo['usagePercentage'] }}" max="100"></progress>
                            </div>
                        </div>

                        {{-- <div class="w-full mb-4">
                            <div class="flex items-center justify-between gap-4 mb-2">
                            <h6
                                class=" text-base block font-sans antialiased leading-relaxed tracking-normal text-blue-gray-900">
                                Storage Percentage
                            </h6>
                            <h6
                                class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                                {{ $systeminfo['storage_percentage'] }}%
                            </h6>
                            </div>
                            <div
                            class="flex-start flex h-2.5 w-full overflow-hidden rounded-full bg-blue-gray-50 font-sans text-xs font-medium">
                            <progress class="progress progress-info w-100 h-full" value="{{ $systeminfo['storage_percentage'] }}" max="100"></progress>
                            </div>
                        </div> --}}

                        <div class="text-sm mt-2">Temperature {{ $systeminfo['temp'] }}</div>
                        <div class="text-sm mt-2">Total RAM: {{ $systeminfo['totalMemory'] }}</div>
                        <div class="text-sm mt-2">Used RAM: {{ $systeminfo['memUsed'] }}</div>
                        <div class="text-sm mt-2">Free RAM: {{ $systeminfo['memFree'] }}</div>
                        <div class="text-sm mt-2">Boot Time: {{ $systeminfo['uptime'] }}</div>
                        {{-- <div class="text-sm mt-2">Architecture: {{ $systeminfo['family'] }}</div> --}}
                    </div>
                @endif
            </div>

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Today's Schedule / Events</div>
                </div>
                <div wire:poll class="overflow-x-auto">
                    {{-- Checking if There's in Events --}}
                    @if ($eventsNow)
                        <div class="text-md">Title: {{ $eventsNow->title }}</div>
                        <div class="text-md">Description: {{ $eventsNow->description }}</div>
                        <div class="text-md">Date: {{ $eventsNow->date }}</div>
                        <div class="text-md">Event Start: {{ $eventsNow->event_start }}</div>
                        <div class="text-md">Event End: {{ $eventsNow->event_end }}</div>
                    @elseif ($schedulesNow)
                        <div class="text-md">Schedule Type:
                            @if ($schedulesNow->isMakeUp == '0')
                                Regular Schedule
                            @else
                                Make-Up Schedule
                            @endif
                        </div>
                        <div class="text-md">Subject: {{ $schedulesNow->subject->subject_name }}</div>
                        <div class="text-md">Instructor: {{ $schedulesNow->instructor->name }}</div>
                        <div class="text-md">Section: {{ $schedulesNow->section->section_name }}</div>
                        <div class="text-md">Day: {{ $schedulesNow->days }}</div>
                        <div class="text-md">Time Frame: {{ $schedulesNow->time_start }} to {{ $schedulesNow->time_end }}</div>
                    @else
                        <div class="text-md">No Schedule / Events as of Now!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

