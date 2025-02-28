
<x-slot:title>Dashboard</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">{{ $greetMessage }}, {{ $genderGreeting }} {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}!</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Admin Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3">

            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-2">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Statistics</div>
                </div>

                <div class="lg:flex lg:flex-column lg:gap-5">
                    <div class="w-full mb-5 shadow stats bg-gradient-to-r from-cyan-500 to-blue-500">
                        <div class="stat">
                            <div class="text-gray-100 stat-figure">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                            <div class="text-gray-100 stat-title">Students</div>
                            <div class="text-gray-100 stat-value">{{ $totalStudents }}</div>
                            {{-- <div class="stat-desc">Jan 1st - Feb 1st</div> --}}
                            </div>
                    </div>

                    <div class="w-full mb-5 shadow stats bg-gradient-to-r from-amber-500 to-pink-500">
                        <div class="stat">
                            <div class="text-gray-100 stat-figure">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-clock"><path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h5"/><path d="M17.5 17.5 16 16.3V14"/><circle cx="16" cy="16" r="6"/></svg>
                            </div>
                            <div class="text-gray-100 stat-title">Schedules</div>
                            <div class="text-gray-100 stat-value">{{ $totalSchedules }}</div>
                            {{-- <div class="stat-desc">↗︎ 400 (22%)</div> --}}
                        </div>
                    </div>

                    <div class="w-full mb-5 shadow stats bg-gradient-to-r from-fuchsia-600 to-pink-600">
                        <div class="stat">
                            <div class="text-gray-100 stat-figure">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                            <div class="text-gray-100 stat-title">Faculties</div>
                            <div class="text-gray-100 stat-value">{{ $totalFaculties }}</div>
                            {{-- <div class="stat-desc">↘︎ 90 (14%)</div> --}}
                        </div>
                    </div>
                </div>

                <div class="lg:flex lg:flex-column lg:gap-5">
                    <div class="w-full mb-5 shadow stats bg-gradient-to-r from-emerald-500 to-emerald-900">
                        <div class="stat">
                            <div class="text-gray-100 stat-figure">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></svg>
                            </div>
                            <div class="text-gray-100 stat-title">Courses</div>
                            <div class="text-gray-100 stat-value">{{ $totalCourses }}</div>
                            {{-- <div class="stat-desc">Jan 1st - Feb 1st</div> --}}
                        </div>
                    </div>

                    <div class="w-full mb-5 shadow stats bg-gradient-to-r from-red-500 to-orange-500">
                        <div class="stat">
                            <div class="text-gray-100 stat-figure">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder"><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/></svg>
                            </div>
                            <div class="text-gray-100 stat-title">Sections</div>
                            <div class="text-gray-100 stat-value">{{ $totalSections }}</div>
                            {{-- <div class="stat-desc">↗︎ 400 (22%)</div> --}}
                        </div>
                    </div>

                    <div class="w-full mb-5 shadow stats bg-gradient-to-r from-emerald-400 to-cyan-400">
                        <div class="stat">
                            <div class="text-gray-100 stat-figure">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-days"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
                            </div>
                            <div class="text-gray-100 stat-title">Events</div>
                            <div class="text-gray-100 stat-value">{{ $totalEvents }}</div>
                            {{-- <div class="stat-desc">↗︎ 400 (22%)</div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
                <div class="flex items-start justify-between mb-4">
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
                                class="block font-sans text-base antialiased leading-relaxed tracking-normal text-blue-gray-900">
                                CPU Usage
                            </h6>
                            <h6
                                class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                                {{ $systeminfo['cpuUsage'] }}%
                            </h6>
                            </div>
                            <div
                            class="flex-start flex h-2.5 w-full overflow-hidden rounded-full bg-blue-gray-50 font-sans text-xs font-medium">
                            <progress class="h-full progress progress-info w-100" value="{{ $systeminfo['cpuUsage'] }}" max="100"></progress>
                            </div>
                        </div>

                        <div class="w-full mb-4">
                            <div class="flex items-center justify-between gap-4 mb-2">
                            <h6
                                class="block font-sans text-base antialiased leading-relaxed tracking-normal text-blue-gray-900">
                                RAM Usage
                            </h6>
                            <h6
                                class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                                {{ $systeminfo['usagePercentage'] }}%
                            </h6>
                            </div>
                            <div
                            class="flex-start flex h-2.5 w-full overflow-hidden rounded-full bg-blue-gray-50 font-sans text-xs font-medium">
                            <progress class="h-full progress progress-info w-100" value="{{ $systeminfo['usagePercentage'] }}" max="100"></progress>
                            </div>
                        </div>

                        {{-- <div class="w-full mb-4">
                            <div class="flex items-center justify-between gap-4 mb-2">
                            <h6
                                class="block font-sans text-base antialiased leading-relaxed tracking-normal text-blue-gray-900">
                                Storage Percentage
                            </h6>
                            <h6
                                class="block font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-blue-gray-900">
                                {{ $systeminfo['storage_percentage'] }}%
                            </h6>
                            </div>
                            <div
                            class="flex-start flex h-2.5 w-full overflow-hidden rounded-full bg-blue-gray-50 font-sans text-xs font-medium">
                            <progress class="h-full progress progress-info w-100" value="{{ $systeminfo['storage_percentage'] }}" max="100"></progress>
                            </div>
                        </div> --}}

                        <div class="mt-2 text-sm">Temperature {{ $systeminfo['temp'] }}</div>
                        <div class="mt-2 text-sm">Total RAM: {{ $systeminfo['totalMemory'] }}</div>
                        <div class="mt-2 text-sm">Used RAM: {{ $systeminfo['memUsed'] }}</div>
                        <div class="mt-2 text-sm">Free RAM: {{ $systeminfo['memFree'] }}</div>
                        <div class="mt-2 text-sm">Boot Time: {{ $systeminfo['uptime'] }}</div>
                        {{-- <div class="mt-2 text-sm">Architecture: {{ $systeminfo['family'] }}</div> --}}
                    </div>
                @endif
            </div>

            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-3">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Current Schedule / Events</div>
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
                        <div class="text-md">Schedule Type: Regular Class</div>
                        <div class="text-md">Course Title: {{ $schedulesNow->course->course_title }}</div>
                        <div class="text-md">Faculty: {{ $schedulesNow->course->faculty->first_name }} {{ $schedulesNow->course->faculty->last_name }}</div>
                        <div class="text-md">Section: {{ $schedulesNow->course->section->program }} {{ $schedulesNow->course->section->year }}{{ $schedulesNow->course->section->block }}</div>
                        <div class="text-md">Day: {{ $schedulesNow->days }}</div>
                        <div class="text-md">Time Frame: {{ Carbon\Carbon::parse($schedulesNow->time_start)->format('h:i A') }} to {{ Carbon\Carbon::parse($schedulesNow->time_end)->format('h:i A') }}</div>
                    @elseif ($makeupClassNow)
                        <div class="text-md">Schedule Type: Make-Up Class</div>
                        <div class="text-md">Course Title: {{ $makeupClassNow->course->course_title }}</div>
                        <div class="text-md">Faculty: {{ $makeupClassNow->course->faculty->first_name }} {{ $makeupClassNow->course->faculty->last_name }}</div>
                        <div class="text-md">Section: {{ $makeupClassNow->course->section->program }} {{ $makeupClassNow->course->section->year }}{{ $makeupClassNow->course->section->block }}</div>
                        <div class="text-md">Day: {{ $makeupClassNow->days }}</div>
                        <div class="text-md">Time Frame: {{ Carbon\Carbon::parse($makeupClassNow->time_start)->format('h:i A') }} to {{ Carbon\Carbon::parse($makeupClassNow->time_end)->format('h:i A') }}</div>
                    @else
                        <div class="text-md">No Schedule / Events as of Now!</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3">

            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-2">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Weekly Student RFID Taps</div>
                </div>
                <div wire:ignore id="barChart">
                </div>
            </div>

            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Students Per Program</div>
                </div>
                <div wire:ignore id="donutChart">
                </div>
            </div>

            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-3">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Events Per Month</div>
                </div>
                <div wire:ignore id="lineChart"></div>
            </div>

        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        var programs = @json($programs); // ["BSIT", "BSCS", "BLIS", "BSIS"]
        var programData = @json($programData); // [30, 40, 0, 50] (example)

        // Students Per Program (Donut Chart)
        var options = {
            chart: {
                type: 'donut',
                height: 300
            },
            series: programData,
            labels: programs,
        }
        var donutChart = new ApexCharts(document.querySelector("#donutChart"), options);
        donutChart.render();

        // Weekly Student RFID Taps (Barchart)
        var options = {
            chart: {
                type: 'bar',
                height: 300
            },
            series: [{
                name: 'Students',
                data: @json($countRFIDData['data'])
            }],
            xaxis: {
                categories: @json($countRFIDData['labels'])
            }
        }
        var barChart = new ApexCharts(document.querySelector("#barChart"), options);
        barChart.render();

        // Count the Event Data
        var options = {
            series: [{
                name: "Events",
                data: @json($countEventData['data'])
            }],
            chart: {
                height: 300,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: @json($countEventData['labels'])
            }
        };

        var lineChart = new ApexCharts(document.querySelector("#lineChart"), options);
        lineChart.render();
    </script>
</x-slot>
