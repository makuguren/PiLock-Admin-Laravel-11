<div>
    @include('user.dashboard.setup')

    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">{{ $greetMessage }}, {{ Auth::user()->name }}</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">User Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>

        <div wire:poll.1s class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Your Current Schedule</div>
                </div>

                <div class="overflow-x-auto">
                    @forelse ($schedules as $schedule)
                        <div class="text-md">Course Title: {{ $schedule->course->course_title }}</div>
                        <div class="text-md">Section: {{ $schedule->course->section->program }}
                            {{ $schedule->course->section->year }}{{ $schedule->course->section->block }}
                        </div>

                        <div class="text-md">Day: {{ $schedule->days }}</div>
                        <div class="text-md">Time Frame: {{ Carbon\Carbon::parse($schedule->time_start)->format('h:i A') }} to {{ Carbon\Carbon::parse($schedule->time_end)->format('h:i A') }}</div>
                    @empty
                        No Current Schedules Found
                    @endforelse
                </div>
            </div>
        </div>

        <div wire:poll.1s class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Your Attendances</div>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead class="bg-base-200 rounded-md text-md">
                            <tr>
                                <th>DATE</th>
                                <th>INSTRUCTOR</th>
                                <th>SECTION</th>
                                <th>SUBJECT</th>
                                <th>IS PRESENT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendances as $attendance)
                                <tr>
                                    <td><div class="">{{ $attendance->date }}</div></td>
                                    <td><div class="">{{ $attendance->course->instructor->name }}</div></td>
                                    <td><div class="">{{ $attendance->student->section->program }} {{ $attendance->student->section->year }}{{ $attendance->student->section->block }}</div></td>
                                    <td><div class="">{{ $attendance->course->course_title }}</div></td>
                                    <td>
                                        <div class="">
                                            @if ($attendance->isPresent == '0')
                                                <div class="badge bg-red-700 gap-2 text-white">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> --}}
                                                    Absent
                                                </div>
                                            @else
                                                <div class="badge bg-green-700 gap-2 text-white">
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> --}}
                                                    Present
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="font-bold text-md">No Attendandes Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('updateInfo_modal').checked = false;
        });
    </script>
</x-slot:scripts>
