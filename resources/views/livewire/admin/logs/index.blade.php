<x-slot:title>
    Logs
</x-slot>

<div>
    <div class="p-6">
        <div class="flex flex-row gap-2">
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
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Filtering</div>
                </div>

                <div class="flex flex-col md:flex-row gap-5">

                    <div class="w-full">
                        <span class="font-medium text-sm">Select Courses and Section</span>
                        <form wire:submit="filter_coursesec">
                            <select wire:model="filter_coursesec" class="select select-bordered flex w-full items-center">
                                <option value="" selected>All Course & Section</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course_title }} -
                                        {{ $course->section->program }}
                                        {{ $course->section->year }}{{ $course->section->block }} -
                                        {{ $course->instructor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <div class="w-full">
                        <span class="font-medium text-sm">Select Date</span>
                        <form wire:submit="filter_date">
                            <label class="flex w-full items-center">
                                <input type="date" wire:model="filter_date" name="date" value="" class="input input-bordered form-control w-full bg-base-100 text-sm" />
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full mb-6"></div>

        <div wire:poll.1000ms class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="bg-base-200 rounded-md text-md">
                        <tr>
                            <th>STUDENT ID</th>
                            <th>NAME</th>
                            <th>SECTION</th>
                            <th>COURSE TITLE</th>
                            <th>INSTRUCTOR</th>
                            <th>DATE</th>
                            <th>TIME IN</th>
                            <th>TIME OUT</th>
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
                                    @if ($log->course_id)
                                        {{ $log->course->section->program }} {{ $log->course->section->year }}{{ $log->course->section->block }}
                                    @else
                                        No Section Found
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    @if ($log->course_id)
                                        {{ $log->course->course_title }}
                                    @else
                                        No Course Title Found
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    @if ($log->course_id)
                                        {{ $log->course->instructor->name }}
                                    @else
                                        No Instructor Found
                                    @endif
                                </div>
                            </td>
                            <td><div class="">{{ $log->date }}</div></td>
                            <td><div class="">{{ $log->time_in }}</div></td>
                            <td>
                                <div class="">
                                    @if ($log->time_out)
                                        {{ $log->time_out }}
                                    @else
                                        No Time Out
                                    @endif
                                </div>
                            </td>
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
