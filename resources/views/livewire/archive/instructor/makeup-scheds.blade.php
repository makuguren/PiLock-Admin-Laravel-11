<x-slot:title>
    Make-Up Schedules
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Make-Up Schedules</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Make-Up Schedules</li>
                </ul>
            </div>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="bg-base-200 rounded-md text-md">
                        <tr>
                            <th>COURSE TITLE</th>
                            <th>INSTRUCTOR</th>
                            <th>DAYS</th>
                            <th>SECTION</th>
                            <th>TIME START</th>
                            <th>TIME END</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($makeupscheds as $schedule)
                            <tr>
                                <td>
                                    <div class="">
                                        @if ($schedule->course_id)
                                            {{ $schedule->course->course_title }}
                                        @else
                                            No Course
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        @if ($schedule->course_id)
                                            {{ $schedule->course->instructor->first_name }} {{ $schedule->course->instructor->last_name }}
                                        @else
                                            No Instructor
                                        @endif
                                    </div>
                                </td>
                                <td><div class="">{{ $schedule->days }}</div></td>
                                <td>
                                    <div class="">
                                        @if ($schedule->course_id)
                                            {{ $schedule->course->section->program }}
                                            {{ $schedule->course->section->year }}{{ $schedule->course->section->block }}
                                        @else
                                            No Section
                                        @endif
                                    </div>
                                </td>
                                <td><div class="">{{ Carbon\Carbon::parse($schedule->time_start)->format('h:i A') }}</div></td>
                                <td><div class="">{{ Carbon\Carbon::parse($schedule->time_end)->format('h:i A') }}</div></td>
                                <td>
                                    @if ($schedule->isApproved == '0')
                                        <div class="badge badge-warning gap-2">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> --}}
                                            Pending
                                        </div>
                                    @elseif ($schedule->isApproved == '1')
                                        <div class="badge bg-green-700 gap-2 text-white">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> --}}
                                            Approved
                                        </div>
                                    @elseif ($schedule->isApproved == '2')
                                        <div class="badge bg-red-700 gap-2 text-white">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> --}}
                                            Declined
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Make-Up Schedules Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
