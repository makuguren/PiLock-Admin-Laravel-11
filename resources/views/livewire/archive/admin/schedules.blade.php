<x-slot:title>
    Schedules
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Schedules</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Schedules</li>
                </ul>
            </div>
            
            <a wire:navigate.hover href="{{ route('archive.admin.schedules.timetable') }}" class="mt-3 bg-orange-700 btn btn-ghost hover:bg-orange-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-grid-3x3"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M3 15h18"/><path d="M9 3v18"/><path d="M15 3v18"/></svg>
                <span class="text-sm text-white">TimeTable View</span>
            </a>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="rounded-md bg-base-200 text-md">
                        <tr>
                            <th>COURSE TITLE</th>
                            <th>INSTRUCTOR</th>
                            <th>DAY</th>
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
                                <td><div class="font-bold">No Schedules Found</div></td>
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
