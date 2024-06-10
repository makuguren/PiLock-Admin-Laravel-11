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
                            <th>ID</th>
                            <th>SUBJECT</th>
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
                            <td><div class="font-bold">{{ $schedule->id }}</div></td>
                            <td>
                                <div class="">
                                    @if ($schedule->subject_id)
                                        {{ $schedule->subject->subject_name }}
                                    @else
                                        No Subject
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    @if ($schedule->instructor_id)
                                        {{ $schedule->instructor->name }}
                                    @else
                                        No Instructor
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ $schedule->days }}</div></td>
                            <td>
                                <div class="">
                                    @if ($schedule->section_id)
                                        {{ $schedule->section->section_name }}
                                    @else
                                        No Section
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ $schedule->time_start }}</div></td>
                            <td><div class="">{{ $schedule->time_end }}</div></td>
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
