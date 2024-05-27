<div>
    @include('admin.students.delete')

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
            {{-- @can('Create Students') --}}
            <a href="{{ route('admin.students.addtaguid') }}" class="btn bg-green-700 hover:bg-green-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" /></svg>
                <span class="text-white text-sm">Add Tag UID</span>
            </a>

            <a href="{{ route('admin.students.create') }}" class="btn bg-blue-700 hover:bg-blue-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" /></svg>
                <span class="text-white text-sm">Add Student</span>
            </a>
            {{-- @endcan --}}
        </div>

        {{-- Alert Message --}}
        @if (session('message'))
        <div role="alert" class="alert alert-success mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span>{{ session('message') }}</span>
        </div>
        @endif

        {{-- Search Button and Etc. --}}
        <div class="flex flex-row items-center gap-5 mb-4">

            <form wire:submit="filter_section">
                <select wire:model="filter_section" class="select select-bordered flex items-center select-sm h-10">
                    <option value="" selected>Select Section</option>
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                    @endforeach
                </select>
            </form>

            <div class="w-full"></div>

            <form wire:submit="search">
                <label class="input input-bordered flex items-center h-10">
                    <input type="text" wire:model="query" class="grow bg-base-100 text-sm" placeholder="Search" />
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70"><path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" /></svg>
                </label>
            </form>

            {{-- <div class="w-full"></div>

            <label for="add_modal" class="btn bg-blue-700 hover:bg-blue-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                <span class="text-white text-sm">Add Subject</span>
            </label> --}}
        </div>

        <div wire:poll.1000ms class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <table class="table">
                    <!-- head -->
                    <thead>
                      <tr class="bg-base-200">
                        <th>STUDENT ID</th>
                        <th>TAG UID</th>
                        <th>NAME</th>
                        <th>YEAR AND SECTION</th>
                        <th>EMAIL</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>
                                    <div class="font-bold">
                                        @if ($student->student_id)
                                            {{ $student->student_id }}
                                        @else
                                            No Student ID Assigned
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        @if ($student->tag_uid)
                                            {{ $student->tag_uid }}
                                        @else
                                            No UID Assigned
                                        @endif
                                    </div>
                                </td>
                                <td><div class="">{{ $student->name }}</div></td>
                                <td>
                                    <div class="">
                                        @if ($student->section_id)
                                            {{ $student->section->section_name }}
                                        @else
                                            No Section Assigned
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        @if ($student->email)
                                            {{ $student->email }}
                                        @else
                                            No Email Assigned
                                        @endif
                                    </div>
                                </td>
                                <th>
                                    <div class="flex flex-row space-x-2">
                                        {{-- @can('Update Students') --}}
                                        <a href="{{ route('admin.students.edit', $student->id) }}" class="btn bg-blue-700 hover:bg-blue-500 btn-sm h-8">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                            <span class="text-white text-sm">Edit</span>
                                        </a>
                                        {{-- @endcan --}}

                                        {{-- @can('Delete Students') --}}
                                        <label for="delete_modal" wire:click="deleteStudent({{ $student->id }})" class="btn bg-red-700 hover:bg-red-500 btn-sm h-8">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                            <span class="text-white text-sm">Delete</span>
                                        </label>
                                        {{-- @endcan --}}
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
                    {{-- {{ $students->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('delete_modal').checked = false;
        });

        function cancel_student() {
            document.getElementById('delete_modal').checked = false;
        }
    </script>
</x-slot>
