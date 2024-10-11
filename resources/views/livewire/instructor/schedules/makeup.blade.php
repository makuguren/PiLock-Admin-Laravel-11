<x-slot:title>
    Make-Up Schedules
</x-slot>

<div>
    {{-- Make-Up Class Schedule Modal --}}
    @include('livewire.instructor.schedules.create')
    @include('livewire.instructor.schedules.edit')
    @include('livewire.instructor.schedules.delete')

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
            {{-- @can('Create Schedules') --}}
            <label for="add_modal" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-clock"><path d="M21 7.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5"/><path d="M16 2v4"/><path d="M8 2v4"/><path d="M3 10h5"/><path d="M17.5 17.5 16 16.3V14"/><circle cx="16" cy="16" r="6"/></svg>
                <span class="text-white text-sm">Add Schedule</span>
            </label>
            {{-- @endcan --}}
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
                            <th>ACTION</th>
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
                                    @if ($schedule->isApproved == '0' || $schedule->isApproved == '2')
                                        <th>
                                            <div class="flex flex-row space-x-2">
                                                @if ($schedule->isApproved == '0')
                                                    <label for="edit_modal" wire:click="editSchedule({{ $schedule->id }})" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 btn-sm h-8">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                                        <span class="text-white text-sm">Edit</span>
                                                    </label>
                                                @endif

                                                <label for="delete_modal" wire:click="deleteSchedule({{ $schedule->id }})" class="btn btn-ghost bg-red-700 hover:bg-red-500 btn-sm h-8">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                    <span class="text-white text-sm">Delete</span>
                                                </label>
                                            </div>
                                        </th>
                                    @endif
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td><div class="font-bold">No Make-Up Schedules Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- <div class="mt-3">
                    {{ $schedules->links() }}
                </div> --}}
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
        });

        function cancel_sched(){
            document.getElementById('add_modal').checked = false;
            document.getElementById('edit_modal').checked = false;
            document.getElementById('delete_modal').checked = false;

            document.getElementById('adddays').value = '';
            document.getElementById('addtime_start').value = '';
            document.getElementById('addtime_end').value = '';

            // document.getElementById('editsubject_id').value = '';
            // document.getElementById('editinstructor_id').value = '';
            // document.getElementById('editsection_id').value = '';
            // document.getElementById('editdays').value = '';
            // document.getElementById('edittime_start').value = '';
            // document.getElementById('edittime_end').value = '';
        }
    </script>
</x-slot>

