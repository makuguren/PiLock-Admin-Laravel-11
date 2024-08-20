<x-slot:title>
    Students
</x-slot>

<div>
    @include('livewire.instructor.students.create')
    @include('livewire.instructor.students.unenroll')

   <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Students</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Students</li>
                </ul>
            </div>

            <label for="create_modal" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-pen"><path d="M2 21a8 8 0 0 1 10.821-7.487"/><path d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/><circle cx="10" cy="8" r="5"/></svg>
                <span class="text-white text-sm">Add Student</span>
            </label>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Filtering</div>
                </div>

                <div class="flex flex-col md:flex-row gap-5">
                    <div class="w-full">
                        <span class="font-medium text-sm">Select Course and Sections</span>
                        <select wire:model="selectedCourseSection" id="section" class="select select-bordered flex w-full items-center">
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

        <div wire:poll.1000ms class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                      <tr class="bg-base-200">
                        <th>STUDENT ID</th>
                        <th>NAME AND EMAIL</th>
                        <th>YEAR AND SECTION</th>
                        <th>COURSE TITLE</th>
                        <th>INSTRUCTOR</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($enrolledstuds as $enrolledstud)
                            @foreach ($enrolledstud->enrolledCourse as $enrolledstd)
                                <tr>
                                    <td>
                                        <div class="font-bold">
                                            {{ $enrolledstd->student->student_id }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                              <div class="mask mask-squircle h-12 w-12">
                                                <img
                                                  src="{{ $enrolledstd->student->avatar ?? '' }}" />
                                              </div>
                                            </div>
                                            <div>
                                              <div class="font-bold">{{ $enrolledstd->student->name }}</div>
                                              <div class="text-sm opacity-50">{{ $enrolledstd->student->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ $enrolledstd->student->section->program }} {{ $enrolledstd->student->section->year }}{{ $enrolledstd->student->section->block }}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ $enrolledstd->course->course_title }}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{ $enrolledstd->course->instructor->name }}
                                        </div>
                                    </td>
                                    <th>
                                        <div class="flex flex-row space-x-2">
                                            <label for="unenroll_modal" wire:click="unenrollStud({{ $enrolledstd->id }})" class="btn btn-ghost bg-red-700 hover:bg-red-500 btn-sm h-8">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                                <span class="text-white text-sm">Unenroll</span>
                                            </label>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td><div class="font-bold">No Students Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{-- {{ $students->links() }} --}}
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
        });

        function cancel_student(){
            document.getElementById('create_modal').checked = false;
            document.getElementById('unenroll_modal').checked = false;

            document.getElementById('addstud_search').value = '';
            document.getElementById('addstud_name').value = '';
            document.getElementById('addstud_section').value = '';
            document.getElementById('addstud_courseId').value = '';
        }
    </script>
</x-slot>
