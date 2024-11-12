<x-slot:title>
    Blocked Students
</x-slot>

<div>
    @include('livewire.faculty.courses.unblock')

    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Blocked Students</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Blocked Students</li>
                </ul>
            </div>

            {{-- <label for="create_modal" class="mt-3 bg-blue-700 btn btn-ghost hover:bg-blue-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-plus"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M9 15h6"/><path d="M12 18v-6"/></svg>
                <span class="text-sm text-white">Add Course</span>
            </label> --}}
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
                <table class="table table-zebra">
                    <thead class="rounded-md bg-base-200 text-md">
                        <tr>
                            <th>STUDENT ID</th>
                            <th>NAME</th>
                            <th>SECTION</th>
                            <th>COURSE TITLE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blockedCourses as $blockedCourse)
                            <tr>
                                <td><div class="font-bold">{{ $blockedCourse->student->student_id }}</div></td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                        <div class="w-12 h-12 mask mask-squircle">
                                            <img
                                            src="{{ $blockedCourse->student->avatar ?? '' }}" />
                                        </div>
                                        </div>
                                        <div>
                                        <div class="font-bold">{{ $blockedCourse->student->first_name }} {{ $blockedCourse->student->last_name }}</div>
                                        <div class="text-sm opacity-50">{{ $blockedCourse->student->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><div class="">{{ $blockedCourse->student->section->program }} {{ $blockedCourse->student->section->year }}{{ $blockedCourse->student->section->block }}</div></td>
                                <td><div class="">{{ $blockedCourse->course->course_title }}</div></td>
                                <th>
                                    <div class="flex flex-row space-x-2">
                                        <label for="unblock_modal" wire:click="unblockStudCourse({{ $blockedCourse->id }})" class="bg-red-700 btn btn-ghost hover:bg-red-500 btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-x"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="17" x2="22" y1="8" y2="13"/><line x1="22" x2="17" y1="8" y2="13"/></svg>
                                            <span class="text-sm text-white">Unblock</span>
                                        </label>
                                    </div>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Block Students Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{-- {{ $faculties->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('unblock_modal').checked = false;
        });

        function cancel_block(){
            document.getElementById('unblock_modal').checked = false;
        }
    </script>
</x-slot>
