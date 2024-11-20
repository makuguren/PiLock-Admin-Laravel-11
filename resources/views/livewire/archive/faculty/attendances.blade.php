<x-slot:title>
    Attendances
</x-slot>

<div>
    @include('livewire.archive.faculty.attendances-dl')
    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Attendances</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Attendances</li>
                </ul>
            </div>

            <label for="download_pdf_modal" class="mt-3 bg-red-700 btn btn-ghost hover:bg-red-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                <span class="text-sm text-white">Export as PDF</span>
            </label>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Filtering</div>
                </div>

                <div class="flex flex-col gap-5 md:flex-row">
                    <div class="w-full">
                        <span class="text-sm font-medium">Course and Section</span>
                        <select wire:model.live="selectedCourseSection" id="section" class="flex items-center w-full mt-1 mb-1 select select-bordered">
                            <option value="">--Course and Section--</option>
                            @foreach($courseSecs as $courseSec)
                                <option value="{{ $courseSec->id }}">
                                    {{ $courseSec->course_title ?? 'No Course Title' }} -
                                    {{ $courseSec->section->program }}
                                    {{ $courseSec->section->year }}{{ $courseSec->section->block }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full">
                        <span class="text-sm font-medium">Date</span>
                        <label class="flex items-center">
                            <input type="date" wire:model.live="selectedDate" name="date" class="block w-full mt-1 mb-1 text-sm input input-bordered form-control bg-base-100" />
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full mb-6"></div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead class="rounded-md bg-base-200 text-md">
                        <tr>
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
                            <th>
                                <button wire:click="sortBy('seat_plan.seat_number')" class="focus:outline-none">
                                    SEAT NO.
                                    @if ($sortField == 'seat_plan.seat_number')
                                        @if ($sortDirection == 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    @endif
                                </button>
                            </th>
                            <th>FACULTY</th>
                            <th>SECTION</th>
                            <th>SUBJECT</th>
                            <th>DATE</th>
                            <th>
                                <button wire:click="sortBy('time_attend')" class="focus:outline-none">
                                    TIME
                                    @if ($sortField == 'time_attend')
                                        @if ($sortDirection == 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    @endif
                                </button>
                            </th>
                            <th>
                                <button wire:click="sortBy('isPresent')" class="focus:outline-none">
                                    STATUS
                                    @if ($sortField == 'isPresent')
                                        @if ($sortDirection == 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    @endif
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td><div class="font-bold">{{ $attendance->student->student_id }}</div></td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                        <div class="w-12 h-12 mask mask-squircle">
                                            <img
                                            src="{{ $attendance->student->avatar ?? '' }}" />
                                        </div>
                                        </div>
                                        <div>
                                        <div class="font-bold">{{ $attendance->student->first_name }} {{ $attendance->student->last_name }}</div>
                                        <div class="text-sm opacity-50">{{ $attendance->student->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><div class="">{{ $attendance->seat_number ?? 'N/A' }}</div></td>
                                <td><div class="">{{ $attendance->course->faculty->first_name }} {{ $attendance->course->faculty->last_name }}</div></td>
                                <td><div class="">{{ $attendance->student->section->program }} {{ $attendance->student->section->year }}{{ $attendance->student->section->block }}</div></td>
                                <td><div class="">{{ $attendance->course->course_title }}</div></td>
                                <td><div class="">{{ $attendance->date }}</div></td>
                                <td><div class="">{{ $attendance->time_attend ? Carbon\Carbon::parse($attendance->time_attend)->format('h:i A') : 'No Time Logged' }}</div></td>
                                <td>
                                    <div class="">
                                        @if ($attendance->isPresent == '0')
                                            <div class="gap-2 text-white bg-red-700 badge">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> --}}
                                                Absent
                                            </div>
                                        @else
                                            <div class="gap-2 text-white bg-green-700 badge">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> --}}
                                                Present
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="font-bold text-md">No Attendandes Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $attendances->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('download_pdf_modal').checked = false;
        });

        function cancel_dlpdf(){
            document.getElementById('download_pdf_modal').checked = false;

            document.getElementById('selsection_id').value = '';
            document.getElementById('selsubject_id').value = '';
            document.getElementById('dlpdfdate').value = '';
        }
    </script>
</x-slot>
