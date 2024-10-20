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
                        <form wire:submit="filter_section">
                            <span class="text-sm font-medium">Select Sections</span>
                            <select wire:model.live="filter_section" class="flex items-center w-full mt-1 select select-bordered">
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
                            <input type="text" wire:model.live.debounce.250ms="query" class="flex w-full mt-1 text-sm input input-bordered" placeholder="Search" />
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