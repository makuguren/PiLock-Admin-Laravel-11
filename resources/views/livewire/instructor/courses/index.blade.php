<x-slot:title>
    Courses
</x-slot>

<div>
    @include('livewire.instructor.courses.create')
    @include('livewire.instructor.courses.edit')
    @include('livewire.instructor.courses.delete')

    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Courses</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Courses</li>
                </ul>
            </div>

            <label for="create_modal" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                <span class="text-white text-sm">Create Courses</span>
            </label>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="bg-base-200 rounded-md text-md">
                        <tr>
                            <th>ID</th>
                            <th>CODE</th>
                            <th>TITLE</th>
                            <th>SECTION</th>
                            <th>ENROLLMENT KEY</th>
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
                                <td><div class="">{{ Crypt::decryptString($course->course_key) }}</div></td>
                                <th>
                                    <div class="flex flex-row space-x-2">
                                        <label for="edit_modal" wire:click="editCourse({{ $course->id }})" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 btn-sm h-8">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                            <span class="text-white text-sm">Edit</span>
                                        </label>

                                        <label for="delete_modal" wire:click="deleteCourse({{ $course->id }})" class="btn btn-ghost bg-red-700 hover:bg-red-500 btn-sm h-8">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                            <span class="text-white text-sm">Delete</span>
                                        </label>
                                    </div>
                                </th>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{-- {{ $instructors->links() }} --}}
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

            document.getElementById('addcourse_code').value = '';
            document.getElementById('addcourse_title').value = '';
            document.getElementById('addsection_id').value = '';
            document.getElementById('addcourse_key').value = '';

            // document.getElementById('editcourse_code').value = '';
            // document.getElementById('editcourse_title').value = '';
            // document.getElementById('editsection_id').value = '';
            // document.getElementById('editcourse_key').value = '';
        }
    </script>
</x-slot>
