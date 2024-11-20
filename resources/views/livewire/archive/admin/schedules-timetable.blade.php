<x-slot:title>
    Schedules (Timetable)
</x-slot>

<div>
    @include('livewire.archive.admin.schedules-view')

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            width: calc(100% / 8);
        }

        th {
            background-color: black;
            color: white;
        }

        td {
            height: 50px;
        }
    </style>

    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Schedules (Timetable)</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Schedules (Timetable)</li>
                </ul>
            </div>

            <a wire:navigate.hover href="{{ route('archive.admin.schedules.index') }}" class="mt-3 bg-orange-700 btn btn-ghost hover:bg-orange-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-grid-3x3"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M3 15h18"/><path d="M9 3v18"/><path d="M15 3v18"/></svg>
                <span class="text-sm text-white">Table View</span>
            </a>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <table>
                    <tr>
                        <th>TIME FRAME</th>
                        <th>MONDAY</th>
                        <th>TUESDAY</th>
                        <th>WEDNESDAY</th>
                        <th>THURSDAY</th>
                        <th>FRIDAY</th>
                        <th>SATURDAY</th>
                        <th>SUNDAY</th>
                    </tr>
                    {{-- @foreach (range(7, 19) as $hour)
                        <tr>
                            <td>{{ date('g:i A', strtotime("$hour:00")) }} - {{ date('g:i A', strtotime(($hour + 1) . ":00")) }}</td>
                            @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                @php
                                    $schedule = $schedules->firstWhere(function ($schedule) use ($day, $hour) {
                                        return $schedule->days == $day && $schedule->time_start->hour == $hour; // Updated field name
                                    });
                                @endphp
                                @if ($schedule)
                                    @php
                                        $startHour = $schedule->time_start->hour;
                                        $endHour = $schedule->time_end->hour;
                                        $rowspan = $endHour - $startHour;
                                    @endphp
                                    <td wire:click="viewSchedule({{ $schedule->id }})" rowspan="{{ $rowspan }}" style="background: orange;">
                                        {{ $schedule->course->course_code }}<br>
                                        {{ $schedule->course->faculty->name }}<br>
                                        {{ $schedule->course->section->program }} {{ $schedule->course->section->year }}{{ $schedule->course->section->block }}
                                    </td>
                                @else
                                    @if (!$schedules->firstWhere(function ($schedule) use ($day, $hour) {
                                        return $schedule->days == $day && $schedule->time_start->hour < $hour && $schedule->time_end->hour > $hour; // Updated field name
                                    }))
                                        <td></td>
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                    @endforeach --}}

                    {{-- Revised Code with removing casts from the model --}}
                    @foreach (range(7, 19) as $hour)
                        <tr>
                            <td>{{ date('g:i A', strtotime("$hour:00")) }} - {{ date('g:i A', strtotime(($hour + 1) . ":00")) }}</td>

                            @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                @php
                                    // Find the schedule for this specific day and hour
                                    $schedule = $schedules->firstWhere(function ($schedule) use ($day, $hour) {
                                        // Extract hours directly using PHP's strtotime to compare time_start and time_end
                                        $scheduleStartHour = date('H', strtotime($schedule->time_start));
                                        return $schedule->days == $day && $scheduleStartHour == $hour;
                                    });
                                @endphp

                                @if ($schedule)
                                    @php
                                        // Calculate hours and rowspan based on time_start and time_end
                                        $startHour = date('H', strtotime($schedule->time_start));
                                        $endHour = date('H', strtotime($schedule->time_end));
                                        $rowspan = $endHour - $startHour;
                                    @endphp

                                    <td wire:click="viewSchedule({{ $schedule->id }})" rowspan="{{ $rowspan }}" style="background: orange;">
                                        {{ $schedule->course->course_code }}<br>
                                        @if ($schedule->course->faculty->gender == '1') MR. @else MS. @endif {{-- strtoupper($schedule->course->faculty->first_name[0]) --}} {{ strtoupper($schedule->course->faculty->last_name) }}<br>
                                        {{ $schedule->course->section->program }} {{ $schedule->course->section->year }}{{ $schedule->course->section->block }}
                                    </td>
                                @else
                                    @if (!$schedules->firstWhere(function ($schedule) use ($day, $hour) {
                                        $scheduleStartHour = date('H', strtotime($schedule->time_start));
                                        $scheduleEndHour = date('H', strtotime($schedule->time_end));
                                        return $schedule->days == $day && $scheduleStartHour < $hour && $scheduleEndHour > $hour;
                                    }))
                                        <td></td>
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('view_schedule_modal', event => {
            const view_schedule_modal = document.getElementById("view_schedule_modal");
            view_schedule_modal.checked = true;
        });

        function cancel_sched(){
            document.getElementById('view_schedule_modal').checked = false;

            // document.getElementById('editcourse_id').value = '';
            // document.getElementById('course_code').value = '';
            // document.getElementById('faculty_name').value = '';
            // document.getElementById('editdays').value = '';
            // document.getElementById('edittime_start').value = '';
            // document.getElementById('edittime_end').value = '';
            // document.getElementById('editlate_duration').value = '';
        }
    </script>
</x-slot>
