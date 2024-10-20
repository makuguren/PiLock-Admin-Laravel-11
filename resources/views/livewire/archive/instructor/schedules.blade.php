<x-slot:title>
    Schedules
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Schedules</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Schedules</li>
                </ul>
            </div>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="bg-base-200 rounded-md text-md">
                        <tr>
                            <th>COURSE TITLE</th>
                            <th>DAYS</th>
                            <th>SECTION</th>
                            <th>TIME START</th>
                            <th>TIME END</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            @foreach ($course->schedule as $schedule)
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
                                    @if ($schedule->isCurrent == '1' && $schedule->isAttend == '0')
                                        <th>
                                            <div class="flex flex-row space-x-2">
                                                <button wire:click="markPresent({{ $schedule->id }})" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 btn-sm h-8">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                                    <span class="text-white text-sm">Mark as Present</span>
                                                </button>
                                            </div>
                                        </th>
                                    @endif
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td><div class="font-bold">No Schedules Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{-- {{ $schedules->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
