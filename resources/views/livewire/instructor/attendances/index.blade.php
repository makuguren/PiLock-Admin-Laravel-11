<x-slot:title>
    Attendances
</x-slot>

<div>
    @include('livewire.instructor.attendances.dlpdf')
    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Attendances</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Attendances</li>
                </ul>
            </div>

            <label for="download_pdf_modal" class="btn btn-ghost bg-red-700 hover:bg-red-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                <span class="text-white text-sm">Download PDF</span>
            </label>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Filtering</div>
                </div>

                <div class="flex flex-col md:flex-row gap-5">
                    <div class="w-full">
                        <span class="font-medium text-sm">Select Course and Sections</span>
                        <select wire:model="selectedCourseSection" id="section" class="select select-bordered flex w-full items-center">
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

                    <div class="w-full">
                        <span class="font-medium text-sm">Select Date</span>
                        <label class="flex items-center">
                            <input type="date" wire:model="selectedDate" name="date" class="input input-bordered block form-control w-full bg-base-100 text-sm" />
                        </label>
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
                            <th>NAME AND EMAIL</th>
                            <th>INSTRUCTOR</th>
                            <th>SECTION</th>
                            <th>SUBJECT</th>
                            <th>DATE</th>
                            <th>IS PRESENT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td><div class="font-bold">{{ $attendance->student->student_id }}</div></td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                        <div class="mask mask-squircle h-12 w-12">
                                            <img
                                            src="{{ $attendance->student->avatar ?? '' }}" />
                                        </div>
                                        </div>
                                        <div>
                                        <div class="font-bold">{{ $attendance->student->name }}</div>
                                        <div class="text-sm opacity-50">{{ $attendance->student->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td><div class="">{{ $attendance->course->instructor->name }}</div></td>
                                <td><div class="">{{ $attendance->student->section->program }} {{ $attendance->student->section->year }}{{ $attendance->student->section->block }}</div></td>
                                <td><div class="">{{ $attendance->course->course_title }}</div></td>
                                <td><div class="">{{ $attendance->date }}</div></td>
                                <td>
                                    <div class="">
                                        @if ($attendance->isPresent == '0')
                                            <div class="badge bg-red-700 gap-2 text-white">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> --}}
                                                Absent
                                            </div>
                                        @else
                                            <div class="badge bg-green-700 gap-2 text-white">
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
                    {{-- {{ $courses->links() }} --}}
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
