<x-slot:title>
    Courses
</x-slot>

<div>
    @include('livewire.faculty.courses.create')
    @include('livewire.faculty.courses.edit')
    @include('livewire.faculty.courses.delete')
    @include('livewire.faculty.courses.code')

    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Courses</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Courses</li>
                </ul>
            </div>

            <label for="create_modal" class="mt-3 bg-blue-700 btn btn-ghost hover:bg-blue-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-plus"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M9 15h6"/><path d="M12 18v-6"/></svg>
                <span class="text-sm text-white">Add Course</span>
            </label>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="rounded-md bg-base-200 text-md">
                        <tr>
                            <th>ID</th>
                            <th>CODE</th>
                            <th>TITLE</th>
                            <th>SECTION</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            <tr>
                                <td><div class="font-bold">{{ $course->id }}</div></td>
                                <td><div class="">{{ $course->course_code }}</div></td>
                                <td><div class="">{{ $course->course_title }}</div></td>
                                <td><div class="">{{ $course->section->program }} {{ $course->section->year }}{{ $course->section->block }}</div></td>
                                <th>
                                    <div class="flex flex-row space-x-2">
                                        <label for="edit_modal" wire:click="editCourse({{ $course->id }})" class="bg-blue-700 btn btn-ghost hover:bg-blue-500 btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                            <span class="text-sm text-white">Edit</span>
                                        </label>

                                        <label for="delete_modal" wire:click="deleteCourse({{ $course->id }})" class="bg-red-700 btn btn-ghost hover:bg-red-500 btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            <span class="text-sm text-white">Delete</span>
                                        </label>

                                        <label for="code_modal" wire:click="copyEnrollmentKey('{{ Crypt::decryptString($course->course_key) }}')" class="bg-orange-700 btn btn-ghost hover:bg-orange-500 btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-copy"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                                            <span class="text-sm text-white">Copy Enrollment Key</span>
                                        </label>

                                        {{-- <button onclick="copyCourseCode()" wire:click="copyCourseCode('{{ Crypt::decryptString($course->course_key) }}')" value="{{ $cpCourseKey }}" id="course_key" class="text-white bg-orange-700 btn btn-ghost hover:bg-orange-500 btn-sm">Copy Course Code</button> --}}
                                    </div>
                                </th>
                            </tr>
                        @empty

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
            document.getElementById('create_modal').checked = false;
            document.getElementById('edit_modal').checked = false;
            document.getElementById('delete_modal').checked = false;
        });

        function cancel_course(){
            document.getElementById('create_modal').checked = false;
            document.getElementById('edit_modal').checked = false;
            document.getElementById('delete_modal').checked = false;
            document.getElementById('code_modal').checked = false;

            document.getElementById('addcourse_code').value = '';
            document.getElementById('addcourse_title').value = '';
            document.getElementById('addsection_id').value = '';
            document.getElementById('addcourse_key').value = '';

            // document.getElementById('editcourse_code').value = '';
            // document.getElementById('editcourse_title').value = '';
            // document.getElementById('editsection_id').value = '';
            // document.getElementById('editcourse_key').value = '';
        }

        function copyEnrollmentKey(){
            var cpEnrollmentKey = document.getElementById("course_key");
            navigator.clipboard.writeText(cpEnrollmentKey.value);
            console.log(cpEnrollmentKey.value);
        }
    </script>
</x-slot>
