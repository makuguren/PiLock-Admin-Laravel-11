<x-slot:title>
    Make-Up Schedules
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Make-Up Schedules</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Make-Up Schedules</li>
                </ul>
            </div>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="rounded-md bg-base-200 text-md">
                        <tr>
                            <th>COURSE TITLE</th>
                            <th>FACULTY</th>
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
                                            {{ $schedule->course->faculty->first_name }} {{ $schedule->course->faculty->last_name }}
                                        @else
                                            No Faculty
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
                                        <div class="gap-2 badge badge-warning">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> --}}
                                            Pending
                                        </div>
                                    @elseif ($schedule->isApproved == '1')
                                        <div class="gap-2 text-white bg-green-700 badge">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> --}}
                                            Approved
                                        </div>
                                    @elseif ($schedule->isApproved == '2')
                                        <div class="gap-2 text-white bg-red-700 badge">
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
