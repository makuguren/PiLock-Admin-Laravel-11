<x-slot:title>
    Courses
</x-slot>

<div>
    {{-- Subjects Modal --}}
    @can('Create Courses')
        @include('livewire.admin.subjects.create')
    @endcan
    @can('Update Courses')
        @include('livewire.admin.subjects.edit')
    @endcan
    @can('Delete Courses')
        @include('livewire.admin.subjects.delete')
    @endcan

    <div class="p-6">
        <div class="flex flex-row">
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
            @can('Create Courses')
            <label for="create_modal" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-plus"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M9 15h6"/><path d="M12 18v-6"/></svg>
                <span class="text-white text-sm">Add Course</span>
            </label>
            @endcan
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="bg-base-200 rounded-md text-md">
                        <tr>
                            <th>ID</th>
                            <th>COURSE CODE</th>
                            <th>COURSE TITLE</th>
                            <th>SECTION</th>
                            <th>INSTRUCTOR</th>
                            {{-- <th>COURSE KEY</th> --}}
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                        <tr>
                            <td><div class="font-bold">{{ $course->id }}</div></td>
                            <td><div class="">{{ $course->course_code }}</div></td>
                            <td><div class="">{{ $course->course_title }}</div></td>
                            <td>
                                <div class="">{{ $course->section->program }}
                                    {{ $course->section->year }}{{ $course->section->block }}
                                </div>
                            </td>
                            <td><div class="">{{ $course->instructor->name }}</div></td>
                            {{-- <td><div class="">{{ $course->course_key }}</div></td> --}}
                            <th>
                                <div class="flex flex-row space-x-2">
                                    @can('Update Courses')
                                    <label for="edit_modal" wire:click="editCourse({{ $course->id }})" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                        <span class="text-white text-sm">Edit</span>
                                    </label>
                                    @endcan

                                    @can('Delete Courses')
                                    <label for="delete_modal" wire:click="deleteCourse({{ $course->id }})" class="btn btn-ghost bg-red-700 hover:bg-red-500 btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        <span class="text-white text-sm">Delete</span>
                                    </label>
                                    @endcan
                                </div>
                            </th>
                        </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Subjects Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $courses->links() }}
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
            document.getElementById('addinstructor_id').value = '';
            document.getElementById('addsection_id').value = '';
            document.getElementById('addcourse_key').value = '';

            // document.getElementById('editcourse_code').value = '';
            // document.getElementById('editcourse_title').value = '';
            // document.getElementById('editsection_id').value = '';
            // document.getElementById('editcourse_key').value = '';
        }
    </script>
</x-slot>
