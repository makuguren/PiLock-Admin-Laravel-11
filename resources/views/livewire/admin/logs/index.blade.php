<div>
    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Logs</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Logs</li>
                </ul>
            </div>

            {{-- Filtering --}}
            <div class="flex flex-column gap-3">

                <div class="hidden lg:block">
                    <span class="text-gray-600 font-medium text-sm">Filter Subject</span>
                    <form wire:submit="filter_subject">
                        <select wire:model="filter_subject" class="select select-bordered flex items-center select-sm h-10">
                            <option value="" selected>Select Subject</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="hidden lg:block">
                    <span class="text-gray-600 font-medium text-sm">Filter Section</span>
                    <form wire:submit="filter_section">
                        <select wire:model="filter_section" class="select select-bordered flex items-center select-sm h-10">
                            <option value="" selected>Select Section</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="hidden lg:block">
                    <span class="text-gray-600 font-medium text-sm">Filter Instructor</span>
                    <form wire:submit="filter_instructor">
                        <select wire:model="filter_instructor" class="select select-bordered flex items-center select-sm h-10">
                            <option value="" selected>Select Instructor</option>
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->instructor_name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="hidden lg:block">
                    <span class="text-gray-600 font-medium text-sm">Filter Date</span>
                    <form wire:submit="filter_date">
                        <label class="input input-bordered flex items-center h-10">
                            <input type="date" wire:model="filter_date" name="date" value="" class="form-control bg-base-100 text-sm" />
                        </label>
                    </form>
                </div>
            </div>
        </div>

        {{-- Responsive --}}
        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md mb-6 lg:hidden">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">Filtering</div>
            </div>
            <div class="overflow-x-auto">
                <div class="mb-3">
                    <span class="text-gray-600 font-medium text-sm">Filter Subject</span>
                    <form wire:submit="filter_subject">
                        <select wire:model="filter_subject" class="select select-bordered flex items-center select-sm h-10 w-full">
                            <option value="" selected>Select Subject</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="mb-3">
                    <span class="text-gray-600 font-medium text-sm">Filter Section</span>
                    <form wire:submit="filter_section">
                        <select wire:model="filter_section" class="select select-bordered flex items-center select-sm h-10 w-full">
                            <option value="" selected>Select Section</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="mb-3">
                    <span class="text-gray-600 font-medium text-sm">Filter Instructor</span>
                    <form wire:submit="filter_instructor">
                        <select wire:model="filter_instructor" class="select select-bordered flex items-center select-sm h-10 w-full">
                            <option value="" selected>Select Instructor</option>
                            @foreach ($instructors as $instructor)
                                <option value="{{ $instructor->id }}">{{ $instructor->instructor_name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="">
                    <span class="text-gray-600 font-medium text-sm">Filter Date</span>
                    <form wire:submit="filter_date">
                        <label class="input input-bordered flex items-center h-10">
                            <input type="date" wire:model="filter_date" name="date" value="" class="form-control bg-base-100 text-sm w-full" />
                        </label>
                    </form>
                </div>
            </div>
        </div>

        <div wire:poll.1000ms class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="bg-base-200 rounded-md text-md">
                        <tr>
                            <th>STUDENT ID</th>
                            <th>NAME</th>
                            <th>SECTION</th>
                            <th>SUBJECT</th>
                            <th>INSTRUCTOR</th>
                            <th>DATE</th>
                            <th>TIME</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                        <tr>
                            <td>
                                <div class="font-bold">
                                    @if ($log->student_id)
                                        {{ $log->student->student_id }}
                                    @else
                                        No Student ID
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    @if ($log->student_id)
                                        {{ $log->student->name }}
                                    @else
                                        No Student Name Found
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    @if ($log->section_id)
                                        {{ $log->section->section_name }}
                                    @else
                                        No Section Found
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    @if ($log->subject_id)
                                        {{ $log->subject->subject_name }}
                                    @else
                                        No Subject Found
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    @if ($log->instructor_id)
                                        {{ $log->instructor->name }}
                                    @else
                                        No Instructor Found
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ $log->date }}</div></td>
                            <td><div class="">{{ $log->time }}</div></td>
                        </tr>
                        @empty
                            <tr>
                                <td><div class="font-bold">No Logs Found</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
