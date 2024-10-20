<x-slot:title>
    Students
</x-slot>

<div>
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
                                              <div class="font-bold">{{ $enrolledstd->student->first_name }} {{ $enrolledstd->student->last_name }}</div>
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
                                            {{ $enrolledstd->course->instructor->first_name }} {{ $enrolledstd->course->instructor->last_name }}
                                        </div>
                                    </td>
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
