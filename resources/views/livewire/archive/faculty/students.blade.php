<x-slot:title>
    Students
</x-slot>

<div>
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
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Filtering</div>
                </div>

                <div class="flex flex-col gap-5 md:flex-row">
                    <div class="w-full">
                        <span class="text-sm font-medium">Select Course and Sections</span>
                        <select wire:model="selectedCourseSection" id="section" class="flex items-center w-full select select-bordered">
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

        <div wire:poll.1000ms class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
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
