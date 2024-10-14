<x-slot:title>
    Schedules
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

    @include('livewire.admin.schedules.import')

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

            <label for="import_modal" class="mt-3 bg-green-700 btn btn-ghost hover:bg-green-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sheet"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><line x1="3" x2="21" y1="9" y2="9"/><line x1="3" x2="21" y1="15" y2="15"/><line x1="9" x2="9" y1="9" y2="21"/><line x1="15" x2="15" y1="9" y2="21"/></svg>
                <span class="text-sm text-white">Import Excel File</span>
            </label>

            @can('Create Regular Schedules')
            <label for="add_modal" class="mt-3 bg-blue-700 btn btn-ghost hover:bg-blue-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-clock"><path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h5"/><path d="M17.5 17.5 16 16.3V14"/><circle cx="16" cy="16" r="6"/></svg>
                <span class="text-sm text-white">Add Schedule</span>
            </label>
            @endcan

            <a wire:navigate.hover href="{{ route('admin.schedules.timetable') }}" class="mt-3 bg-orange-700 btn btn-ghost hover:bg-orange-500 w-55 btn-sm">
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
                            <th>DAYS</th>
                            <th>SECTION</th>
                            <th>TIME START</th>
                            <th>TIME END</th>
                            <th>ACTION</th>
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
                            <th>
                                <div class="flex flex-row space-x-2">
                                    @can('Update Regular Schedules')
                                    <label for="edit_modal" wire:click="editSchedule({{ $schedule->id }})" class="h-8 bg-blue-700 btn btn-ghost hover:bg-blue-500 btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                        <span class="text-sm text-white">Edit</span>
                                    </label>
                                    @endcan

                                    @can('Delete Regular Schedules')
                                    <label for="delete_modal" wire:click="deleteSchedule({{ $schedule->id }})" class="h-8 bg-red-700 btn btn-ghost hover:bg-red-500 btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        <span class="text-sm text-white">Delete</span>
                                    </label>
                                    @endcan

                                    {{-- Code to show Execute instantly Schedules between time_start and time_end based on the current time and day. It shows when isCurrent is equal to 0. --}}
                                    @php
                                        $currDateTime = Carbon\Carbon::now('Asia/Manila');
                                    @endphp

                                    @if ($currDateTime->format('l') == $schedule->days && $currDateTime->format('H:i:s') >= $schedule->time_start && $currDateTime->format('H:i:s') <= $schedule->time_end && $schedule->isCurrent == '0')
                                        <button type="button" wire:click="executeSched({{ $schedule->id }})" class="h-8 bg-orange-700 btn btn-ghost hover:bg-orange-500 btn-sm">
                                            <span class="text-sm text-white">Execute</span>
                                        </button>
                                    @endif
                                </div>
                            </th>
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

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('add_modal').checked = false;
            document.getElementById('edit_modal').checked = false;
            document.getElementById('delete_modal').checked = false;

            document.getElementById('import_modal').checked = false;

            document.getElementById('import_file').value = '';

            document.getElementById('course_code').value = '';
            document.getElementById('instructor_name').value = '';
        });

        function cancel_sched(){
            document.getElementById('add_modal').checked = false;
            document.getElementById('edit_modal').checked = false;
            document.getElementById('delete_modal').checked = false;
            document.getElementById('import_modal').checked = false;

            document.getElementById('addcourse_id').value = '';
            document.getElementById('adddays').value = '';
            document.getElementById('addtime_start').value = '';
            document.getElementById('addtime_end').value = '';
            document.getElementById('addlate_duration').value = '';

            document.getElementById('course_code').value = '';
            document.getElementById('instructor_name').value = '';
            document.getElementById('import_file').value = '';

            // document.getElementById('editsubject_id').value = '';
            // document.getElementById('editinstructor_id').value = '';
            // document.getElementById('editsection_id').value = '';
            // document.getElementById('editdays').value = '';
            // document.getElementById('edittime_start').value = '';
            // document.getElementById('edittime_end').value = '';
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
