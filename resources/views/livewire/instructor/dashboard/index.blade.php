<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Dashboard</h1>
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
                    @if ($curschedule)
                        <div class="text-md">Subject: {{ $curschedule->subject->subject_name }}</div>
                        <div class="text-md">Section: {{ $curschedule->section->section_name }}</div>
                        <div class="text-md">Day: {{ $curschedule->days }}</div>
                        <div class="text-md">Time Frame: {{ $curschedule->time_start }} to {{ $curschedule->time_end }}</div>

                        @if ($curschedule->isAttend == 0)
                            <div class="flex flex-row space-x-2 mt-3">
                                <button wire:click="markPresent({{ $curschedule->id }})" class="btn bg-blue-700 hover:bg-blue-500 btn-sm h-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                    <span class="text-white text-sm">Mark as Present</span>
                                </button>
                            </div>
                        @endif
                    @else
                        <div class="text-md">No Current Schedule Found!</div>
                    @endif
                </div>
            </div>

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-1">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Current Attendance</div>
                </div>

                <div class="stats w-full shadow bg-gradient-to-r from-cyan-500 to-blue-500 mb-5">
                    <div class="stat">
                        <div class="stat-figure text-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"></path></svg>
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
