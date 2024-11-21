<x-slot:title>
    Students
</x-slot>

<div>
    @can('Delete Students')
        @include('livewire.admin.students.delete')
    @endcan
    @can('Disable RFID')
        @include('livewire.admin.students.disablerfid')
    @endcan

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

            @can('Add Tag UID to Students')
            <a wire:navigate.hover href="{{ route('admin.students.addtaguid') }}" class="mt-3 bg-orange-700 btn btn-ghost hover:bg-orange-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-id-card"><path d="M16 10h2"/><path d="M16 14h2"/><path d="M6.17 15a3 3 0 0 1 5.66 0"/><circle cx="9" cy="11" r="2"/><rect x="2" y="5" width="20" height="14" rx="2"/></svg>
                <span class="text-sm text-white">Add Tag UID</span>
            </a>
            @endcan
            @can('Create Students')
            <a wire:navigate.hover href="{{ route('admin.students.create') }}" class="mt-3 bg-blue-700 btn btn-ghost hover:bg-blue-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-pen"><path d="M2 21a8 8 0 0 1 10.821-7.487"/><path d="M21.378 16.626a1 1 0 0 0-3.004-3.004l-4.01 4.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/><circle cx="10" cy="8" r="5"/></svg>
                <span class="text-sm text-white">Add Student</span>
            </a>
            @endcan
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Filtering</div>
                </div>

                <div class="flex flex-col gap-5 md:flex-row">
                    <div class="w-full">
                        <form wire:submit="filter_section">
                            <span class="text-sm font-medium">Select Sections</span>
                            <select wire:model.live="filter_section" class="flex items-center w-full mt-2 select select-bordered">
                                <option value="" selected>All Sections</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->program }} {{ $section->year }}{{ $section->block }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <div class="w-full">
                        <form wire:submit="search">
                            <span class="text-sm font-medium">Search Students</span>
                            <input type="text" wire:model.live.debounce.250ms="query" class="flex w-full mt-2 text-sm input input-bordered" placeholder="Search" />
                        </form>
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
                        <th>
                            <button wire:click="sortBy('student_id')" class="focus:outline-none">
                                STUDENT ID
                                @if ($sortField == 'student_id')
                                    @if ($sortDirection == 'asc')
                                        ↑
                                    @else
                                        ↓
                                    @endif
                                @endif
                            </button>
                        </th>
                        <th>TAG UID</th>
                        <th>
                            <button wire:click="sortBy('last_name')" class="focus:outline-none">
                                NAME AND EMAIL
                                @if ($sortField == 'last_name')
                                    @if ($sortDirection == 'asc')
                                        ↑
                                    @else
                                        ↓
                                    @endif
                                @endif
                            </button>
                        </th>
                        <th>YEAR AND SECTION</th>
                        <th>GENDER</th>
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
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                          <div class="w-12 h-12 mask mask-squircle">
                                            <img
                                              src="{{ $student->avatar ?? '' }}" />
                                          </div>
                                        </div>
                                        <div>
                                          <div class="font-bold">{{ $student->first_name }} {{ $student->last_name }}</div>
                                          <div class="text-sm opacity-50">{{ $student->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        @if ($student->section_id)
                                            {{ $student->section->program }} {{ $student->section->year }}{{ $student->section->block }}
                                        @else
                                            No Section Assigned
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="">
                                        @if ($student->gender)
                                            @if ($student->gender == '1')
                                                Male
                                            @elseif ($student->gender == '2')
                                                Female
                                            @endif
                                        @else
                                            No Gender Assigned
                                        @endif
                                    </div>
                                </td>
                                <th>
                                    <div class="flex flex-row space-x-2">
                                        @can('Update Students')
                                        <a wire:navigate.hover href="{{ route('admin.students.edit', $student->id) }}" class="h-8 bg-blue-700 btn btn-ghost hover:bg-blue-500 btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                            <span class="text-sm text-white">Edit</span>
                                        </a>
                                        @endcan

                                        @can('Delete Students')
                                        <label for="delete_modal" wire:click="deleteStudent({{ $student->id }})" class="h-8 bg-red-700 btn btn-ghost hover:bg-red-500 btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            <span class="text-sm text-white">Delete</span>
                                        </label>
                                        @endcan

                                        @can('Disable RFID')
                                            @if ($student->tag_uid)
                                                <label for="disable_modal" wire:click="disableRFID({{ $student->id }})" class="h-8 bg-orange-700 btn btn-ghost hover:bg-orange-500 btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-id-card"><path d="M16 10h2"/><path d="M16 14h2"/><path d="M6.17 15a3 3 0 0 1 5.66 0"/><circle cx="9" cy="11" r="2"/><rect x="2" y="5" width="20" height="14" rx="2"/></svg>
                                                    <span class="text-sm text-white">Disable RFID</span>
                                                </label>
                                            @endif
                                        @endcan
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
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('delete_modal').checked = false;
            document.getElementById('disable_modal').checked = false;
        });

        function cancel_student() {
            document.getElementById('delete_modal').checked = false;
            document.getElementById('disable_modal').checked = false;
        }
    </script>
</x-slot>
