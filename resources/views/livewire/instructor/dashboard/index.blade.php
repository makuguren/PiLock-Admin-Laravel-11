<x-slot:title>
    Dashboard
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">{{ $greetMessage }}, {{ Auth::user()->name }}</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Instructor Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>

        <div wire:poll.1s class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-1">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Current Schedule</div>
                </div>

                <div class="overflow-x-auto">
                    @foreach ($courses as $course)
                        @foreach ($course->schedule as $schedule)
                            <div class="text-md">Course Title: {{ $schedule->course->course_title }}</div>
                            <div class="text-md">Section: {{ $schedule->course->section->program }}
                                {{ $schedule->course->section->year }}{{ $schedule->course->section->block }}
                            </div>
                            <div class="text-md">Day: {{ $schedule->days }}</div>
                            <div class="text-md">Time Frame: {{ Carbon\Carbon::parse($schedule->time_start)->format('h:i A') }} to {{ Carbon\Carbon::parse($schedule->time_end)->format('h:i A') }}</div>

                            @if ($schedule->isAttend == 0)
                                <div class="flex flex-row space-x-2 mt-3">
                                    <button wire:click="markPresent({{ $schedule->id }})" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 btn-sm h-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                        <span class="text-white text-sm">Mark as Present / Unlock Door Remotely</span>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
{{--
                    @if ($courses != null)
                        <div class="text-md">Course Title: {{ optional($courses)->course->course_title }}</div>
                        <div class="text-md">Section: {{ optional($courses)->course->section->program }}
                            {{ optional($courses)->course->section->year }}{{ optional($courses)->course->section->block }}
                        </div>
                        <div class="text-md">Day: {{ $courses->days }}</div>
                        <div class="text-md">Time Frame: {{ Carbon\Carbon::parse($courses->time_start)->format('h:m A') }} to {{ Carbon\Carbon::parse($courses->time_end)->format('h:m A') }}</div>


                    @else
                        <div class="text-md">No Current Schedule Found!</div>
                    @endif --}}
                </div>
            </div>

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-1">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Current Attendance</div>
                </div>

                <div class="stats w-full shadow bg-gradient-to-r from-cyan-500 to-blue-500 mb-5">
                    <div class="stat">
                        <div class="stat-figure text-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div class="stat-title text-gray-100">No. of Students Present</div>
                        <div class="stat-value text-gray-100">{{ $totalPresent }}/{{ $totalStudents }}</div>
                        {{-- <div class="stat-desc">Jan 1st - Feb 1st</div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
