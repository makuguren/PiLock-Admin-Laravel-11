<x-slot:title>
    Students
</x-slot>

<div>
    @include('livewire.faculty.students.create')
    @include('livewire.faculty.students.unenroll')
    @include('livewire.faculty.students.block')

   <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Students</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Students</li>
                </ul>
            </div>

            <label for="create_modal" class="mt-3 bg-blue-700 btn btn-ghost hover:bg-blue-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-pen"><path d="M2 21a8 8 0 0 1 10.821-7.487"/><path d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/><circle cx="10" cy="8" r="5"/></svg>
                <span class="text-sm text-white">Add Student</span>
            </label>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Filtering</div>
                </div>

                <div class="flex flex-col gap-5 md:flex-row">
                    <div class="w-full">
                        <span class="text-sm font-medium">Select Course and Sections</span>
                        <select wire:model.live="selectedCourseSection" id="section" class="flex items-center w-full mt-2 select select-bordered">
                            <option value="">All Course and Section</option>
                            @foreach($courseSecs as $courseSec)
                                <option value="{{ $courseSec->id }}">
                                    {{ $courseSec->course_title ?? 'No Course Title' }} -
                                    {{ $courseSec->section->program }}
                                    {{ $courseSec->section->year }}{{ $courseSec->section->block }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full mb-6"></div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                      <tr class="bg-base-200">
                        <th>STUDENT ID</th>
                        <th>
                            <button wire:click="sortBy('users.last_name')" class="focus:outline-none">
                                NAME AND EMAIL
                                @if ($sortField == 'users.last_name')
                                    @if ($sortDirection == 'asc')
                                        ↑
                                    @else
                                        ↓
                                    @endif
                                @endif
                            </button>
                        </th>
                        <th>YEAR AND SECTION</th>
                        <th>COURSE TITLE</th>
                        <th>FACULTY</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($enrolledstuds as $enrolledstud)
                            <tr>
                                <td>
                                    <div class="font-bold">
                                        {{ $enrolledstud->student->student_id }}
                                    </div>
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="w-12 h-12 mask mask-squircle">
                                            <img
                                                src="{{ $enrolledstud->student->avatar ?? '' }}" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">{{ $enrolledstud->student->first_name }} {{ $enrolledstud->student->last_name }}</div>
                                            <div class="text-sm opacity-50">{{ $enrolledstud->student->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        {{ $enrolledstud->student->section->program }} {{ $enrolledstud->student->section->year }}{{ $enrolledstud->student->section->block }}
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        {{ $enrolledstud->course->course_title }}
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        {{ $enrolledstud->course->faculty->first_name }} {{ $enrolledstud->course->faculty->last_name }}
                                    </div>
                                </td>
                                <th>
                                    <div class="flex flex-row space-x-2">
                                        <label for="unenroll_modal" wire:click="unenrollStud({{ $enrolledstud->id }})" class="bg-red-700 btn btn-ghost hover:bg-red-500 btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            <span class="text-sm text-white">Unenroll</span>
                                        </label>

                                        <label for="block_modal" wire:click="blockStudCourse({{ $enrolledstud->student->id }}, {{ $enrolledstud->course->id }}, {{ $enrolledstud->id }})" class="bg-red-700 btn btn-ghost hover:bg-red-500 btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-x"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="17" x2="22" y1="8" y2="13"/><line x1="22" x2="17" y1="8" y2="13"/></svg>
                                            <span class="text-sm text-white">Block</span>
                                        </label>
                                    </div>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Students Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $enrolledstuds->links() }}
                </div>
            </div>
        </div>
   </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('create_modal').checked = false;
            document.getElementById('unenroll_modal').checked = false;
            document.getElementById('block_modal').checked = false;
        });

        function cancel_student(){
            document.getElementById('create_modal').checked = false;
            document.getElementById('unenroll_modal').checked = false;

            document.getElementById('addstud_search').value = '';
            document.getElementById('addstud_fname').value = '';
            document.getElementById('addstud_lname').value = '';
            document.getElementById('addstud_section').value = '';
            document.getElementById('addstud_courseId').value = '';
        }

        function cancel_block(){
            document.getElementById('block_modal').checked = false;
        }
    </script>
</x-slot>
