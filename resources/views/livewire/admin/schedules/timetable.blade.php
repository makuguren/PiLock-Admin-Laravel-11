<x-slot:title>
    Schedules (Timetable)
</x-slot>

<div>
    {{-- Schedules Modal --}}
    @can('Create Regular Schedules')
        @include('livewire.admin.schedules.create')
    @endcan
    @can('Update Regular Schedules')
        @include('livewire.admin.schedules.edit')
    @endcan
    @can('Delete Regular Schedules')
        @include('livewire.admin.schedules.delete')
    @endcan
        @include('livewire.admin.schedules.view')

        @include('livewire.admin.schedules.import')

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
                <h1 class="font-bold text-2xl mb-2">Schedules (Timetable)</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Schedules (Timetable)</li>
                </ul>
            </div>

            <label for="import_modal" class="btn btn-ghost bg-green-700 hover:bg-green-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sheet"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><line x1="3" x2="21" y1="9" y2="9"/><line x1="3" x2="21" y1="15" y2="15"/><line x1="9" x2="9" y1="9" y2="21"/><line x1="15" x2="15" y1="9" y2="21"/></svg>
                <span class="text-white text-sm">Import Excel File</span>
            </label>

            @can('Create Regular Schedules')
            <label for="add_modal" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-clock"><path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h5"/><path d="M17.5 17.5 16 16.3V14"/><circle cx="16" cy="16" r="6"/></svg>
                <span class="text-white text-sm">Add Schedule</span>
            </label>
            @endcan

            <a wire:navigate.hover href="{{ route('admin.schedules.index') }}" class="btn btn-ghost bg-orange-700 hover:bg-orange-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-grid-3x3"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M3 15h18"/><path d="M9 3v18"/><path d="M15 3v18"/></svg>
                <span class="text-white text-sm">Table View</span>
            </a>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
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
                                        {{ $schedule->course->instructor->name }}<br>
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
                                        @if ($schedule->course->instructor->gender == '1') MR. @else MS. @endif {{-- strtoupper($schedule->course->instructor->first_name[0]) --}} {{ strtoupper($schedule->course->instructor->last_name) }}<br>
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
        window.addEventListener('close-modal', event => {
            document.getElementById('add_modal').checked = false;
            document.getElementById('edit_modal').checked = false;
            document.getElementById('delete_modal').checked = false;
            document.getElementById('import_modal').checked = false;
            document.getElementById('view_schedule_modal').checked = false;

            document.getElementById('import_file').value = '';
        });

        window.addEventListener('view_schedule_modal', event => {
            const view_schedule_modal = document.getElementById("view_schedule_modal");
            view_schedule_modal.checked = true;
        });

        function cancel_sched(){
            document.getElementById('add_modal').checked = false;
            document.getElementById('edit_modal').checked = false;
            document.getElementById('delete_modal').checked = false;
            document.getElementById('import_modal').checked = false;
            document.getElementById('view_schedule_modal').checked = false;

            document.getElementById('addcourse_id').value = '';
            document.getElementById('course_code').value = '';
            document.getElementById('instructor_name').value = '';
            document.getElementById('adddays').value = '';
            document.getElementById('addtime_start').value = '';
            document.getElementById('addtime_end').value = '';
            document.getElementById('import_file').value = '';

            // document.getElementById('editsubject_id').value = '';
            // document.getElementById('editinstructor_id').value = '';
            // document.getElementById('editsection_id').value = '';
            // document.getElementById('editdays').value = '';
            // document.getElementById('edittime_start').value = '';
            // document.getElementById('edittime_end').value = '';
        }

        function enable_sched(){
            document.getElementById('editcourse_id').disabled = false;
            document.getElementById('editdays').disabled = false;
            document.getElementById('edittime_start').disabled = false;
            document.getElementById('edittime_end').disabled = false;
            document.getElementById('updateBtn').disabled = false;
            document.getElementById('deleteBtn').disabled = false;
        }

        function delete_sched(){
            const delete_modal = document.getElementById("delete_modal");
            delete_modal.checked = true;
            view_schedule_modal.checked = false;
        }

        function disableButton() {
            let button = document.getElementById('upload-button');
            let timerElement = document.getElementById('timer');
            let countdown = 10;

            button.disabled = true;
            timerElement.textContent = `Please wait in ${countdown} to enable Import`;

            // Start the countdown
            let timerInterval = setInterval(function() {
                countdown--;
                timerElement.textContent = `Please wait in ${countdown} to enable Import`;

                if (countdown <= 0) {
                    clearInterval(timerInterval);
                    button.disabled = false;
                    timerElement.textContent = ''; // Clear the timer text
                }
            }, 1000);
        }
    </script>
</x-slot>
