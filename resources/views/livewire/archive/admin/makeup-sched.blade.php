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
                            <th>INSTRUCTOR</th>
                            <th>DAYS</th>
                            <th>SECTION</th>
                            <th>TIME START</th>
                            <th>TIME END</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                        <tr>
                            <td>
                                <div class="">
                                    @if ($schedule->course_id)
                                        {{ $schedule->course->course_title }}
                                    @else
                                        No Subject
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
                                        {{ $schedule->course->section->program }} {{ $schedule->course->section->year }}{{ $schedule->course->section->block }}
                                    @else
                                        No Section
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ Carbon\Carbon::parse($schedule->time_start)->format('h:i A') }}</div></td>
                            <td><div class="">{{ Carbon\Carbon::parse($schedule->time_end)->format('h:i A') }}</div></td>
                        </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Make-Up Schedules Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $schedules->links() }}
                </div>
            </div>
        </div>
    </div>
</div>