<div>
    @include('instructor.attendances.dlpdf')
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

            <label for="download_pdf_modal" class="btn bg-red-700 hover:bg-red-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
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
                        <span class="font-medium text-sm">Select Sections</span>
                        <select wire:model="selectedSection" id="section" class="select select-bordered flex w-full items-center">
                            <option value="">All Sections</option>
                            @foreach($sections as $id => $section)
                                <option value="{{ $id }}">{{ $section }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full">
                        <span class="font-medium text-sm">Select Subjects</span>
                        <select wire:model="selectedSubject" id="subject" class="select select-bordered flex w-full items-center">
                            <option value="">All Subjects</option>
                            @foreach($subjects as $id => $subject)
                                <option value="{{ $id }}">{{ $subject }}</option>
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

        <div wire:poll.1s class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
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
                        @forelse ($schedules as $schedule)
                            @foreach ($schedule->attendance as $attendance)
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
                                <td><div class="">{{ $schedule->instructor->name }}</div></td>
                                <td><div class="">{{ $attendance->student->section->section_name }}</div></td>
                                <td><div class="">{{ $schedule->subject->subject_name }}</div></td>
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
                            @endforeach
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
            document.getElementById('download_pdf_modal').checked = false;
        });

        function cancel_dlpdf(){
            document.getElementById('download_pdf_modal').checked = false;

            document.getElementById('selsection_id').value = '';
            document.getElementById('selsubject_id').value = '';
            document.getElementById('dlpdfdate').value = '';
        }
    </script>
</x-slot:scripts>
