<x-slot:title>
    Logs
</x-slot>

<div>
    @include('livewire.admin.logs.download')
    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Logs</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Logs</li>
                </ul>
            </div>

            {{-- Buttons for Enabling Live without Reloading Page. --}}
            @if ($wirePoll === true)
                <button wire:click="getWirePollSwitch(false)" class="btn btn-ghost bg-green-700 hover:bg-green-500 w-55 btn-sm mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-id-card"><path d="M16 10h2"/><path d="M16 14h2"/><path d="M6.17 15a3 3 0 0 1 5.66 0"/><circle cx="9" cy="11" r="2"/><rect x="2" y="5" width="20" height="14" rx="2"/></svg>
                    <span class="text-white text-sm">Live Reload ON</span>
                </button>
            @else
                <button wire:click="getWirePollSwitch(true)" class="btn btn-ghost bg-red-700 hover:bg-red-500 w-55 btn-sm mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-id-card"><path d="M16 10h2"/><path d="M16 14h2"/><path d="M6.17 15a3 3 0 0 1 5.66 0"/><circle cx="9" cy="11" r="2"/><rect x="2" y="5" width="20" height="14" rx="2"/></svg>
                    <span class="text-white text-sm">Live Reload OFF</span>
                </button>
            @endif

            <label for="download_logs_modal" class="btn btn-ghost bg-red-700 hover:bg-red-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                <span class="text-white text-sm">Download Logs</span>
            </label>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Filtering</div>
                </div>

                <div class="flex flex-col md:flex-row gap-5">

                    <div class="w-full">
                        <span class="font-medium text-sm">Select Courses and Section</span>
                        <form wire:submit="filter_coursesec">
                            <select wire:model="filter_coursesec" class="select select-bordered flex w-full items-center">
                                <option value="" selected>All Course & Section</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course_title }} -
                                        {{ $course->section->program }}
                                        {{ $course->section->year }}{{ $course->section->block }} -
                                        {{ $course->instructor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <div class="w-full">
                        <span class="font-medium text-sm">Select Date</span>
                        <form wire:submit="filter_date">
                            <label class="flex w-full items-center">
                                <input type="date" wire:model="filter_date" name="date" value="" class="input input-bordered form-control w-full bg-base-100 text-sm" />
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full mb-6"></div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="bg-base-200 rounded-md text-md">
                        <tr>
                            <th>STUDENT ID</th>
                            <th>NAME</th>
                            <th>SECTION</th>
                            <th>COURSE TITLE</th>
                            <th>INSTRUCTOR</th>
                            <th>DATE</th>
                            <th>
                                <button wire:click="sortBy('time_in')" class="focus:outline-none">
                                    TIME IN
                                    @if ($sortField == 'time_in')
                                        @if ($sortDirection == 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    @endif
                                </button>
                            </th>
                            <th>
                                <button wire:click="sortBy('time_out')" class="focus:outline-none">
                                    TIME OUT
                                    @if ($sortField == 'time_out')
                                        @if ($sortDirection == 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    @endif
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody @if($wirePoll === true) wire:poll.1000ms @endif>
                        @forelse ($logs as $log)
                        <tr>
                            <td>
                                <div class="font-bold">
                                    @if ($log->student_id)
                                        {{ $log->student->student_id }}
                                    @else
                                        No Student ID
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    @if ($log->student_id)
                                        {{ $log->student->first_name }} {{ $log->student->last_name }}
                                    @else
                                        No Student Name Found
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    @if ($log->course_id)
                                        {{ $log->course->section->program }} {{ $log->course->section->year }}{{ $log->course->section->block }}
                                    @else
                                        No Section Found
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    @if ($log->course_id)
                                        {{ $log->course->course_title }}
                                    @else
                                        No Course Title Found
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    @if ($log->course_id)
                                        {{ $log->course->instructor->first_name }} {{ $log->course->instructor->last_name }}
                                    @else
                                        No Instructor Found
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ $log->date }}</div></td>
                            <td><div class="">{{ $log->time_in }}</div></td>
                            <td>
                                <div class="">
                                    @if ($log->time_out)
                                        {{ $log->time_out }}
                                    @else
                                        No Time Out
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Logs Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('download_logs_modal').checked = false;
        });

        function cancel_logs(){
            document.getElementById('download_logs_modal').checked = false;
        }
    </script>
</x-slot>
