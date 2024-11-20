<x-slot:title>
    Dashboard
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">{{ $greetMessage }}, {{ $genderGreeting }} {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}!</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Faculty Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>

        <div wire:poll.1s class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-2">
            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Current Schedule</div>
                </div>

                <div class="overflow-x-auto">
                    @if ($schedules->isNotEmpty())
                        @foreach ($schedules as $schedule)
                            <div class="text-md">Course Title: {{ $schedule->course->course_title }}</div>
                            <div class="text-md">Section: {{ $schedule->course->section->program }}
                                {{ $schedule->course->section->year }}{{ $schedule->course->section->block }}
                            </div>
                            <div class="text-md">Day: {{ $schedule->days }}</div>
                            <div class="text-md">Time Frame: {{ Carbon\Carbon::parse($schedule->time_start)->format('h:i A') }} to {{ Carbon\Carbon::parse($schedule->time_end)->format('h:i A') }}</div>

                            @if ($schedule->isAttend == 0)
                                <div class="flex flex-row mt-3 space-x-2">
                                    <button wire:click="markPresent({{ $schedule->id }})" class="h-8 bg-blue-700 btn btn-ghost hover:bg-blue-500 btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                        <span class="text-sm text-white">Mark as Present / Unlock Door Remotely</span>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    @elseif ($makeupSched->isNotEmpty())
                        @foreach ($makeupSched as $schedule)
                            <div class="text-md">Course Title: {{ $schedule->course->course_title }}</div>
                            <div class="text-md">Section: {{ $schedule->course->section->program }}
                                {{ $schedule->course->section->year }}{{ $schedule->course->section->block }}
                            </div>
                            <div class="text-md">Day: {{ $schedule->days }}</div>
                            <div class="text-md">Time Frame: {{ Carbon\Carbon::parse($schedule->time_start)->format('h:i A') }} to {{ Carbon\Carbon::parse($schedule->time_end)->format('h:i A') }}</div>

                            @if ($schedule->isAttend == 0)
                                <div class="flex flex-row mt-3 space-x-2">
                                    <button wire:click="markPresent({{ $schedule->id }})" class="h-8 bg-blue-700 btn btn-ghost hover:bg-blue-500 btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                        <span class="text-sm text-white">Mark as Present / Unlock Door Remotely</span>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    @else
                        No Current Schedules Found
                    @endif
                </div>
            </div>

            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Current Attendance</div>
                </div>

                <div class="w-full mb-5 shadow stats bg-gradient-to-r from-cyan-500 to-blue-500">
                    <div class="stat">
                        <div class="text-gray-100 stat-figure">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div class="text-gray-100 stat-title">No. of Students Present</div>
                        <div class="text-gray-100 stat-value">{{ $totalPresent }}/{{ $totalStudents }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
