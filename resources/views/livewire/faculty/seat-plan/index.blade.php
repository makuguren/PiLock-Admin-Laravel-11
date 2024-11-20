<x-slot:title>
    Laboratory Seat Plan
</x-slot>

<div>
    @include('livewire.faculty.seat-plan.preview')
    @include('livewire.faculty.seat-plan.download')

    {{-- <ul wire:sortable="updateTaskOrder">
        @foreach ($seatplan as $seatplan)
            <li wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}">
                <h4 wire:sortable.handle>{{ $seatplan->student_id }}</h4>
                <button wire:click="removeTask({{ $seatplan->id }})">Remove</button>
            </li>
        @endforeach
    </ul> --}}

    {{-- <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead class="rounded-md bg-base-200 text-md">
                    <tr>
                        <th>ID</th>
                        <th>STUDENT ID</th>
                        <th>SEAT NUMBER</th>
                    </tr>
                </thead>
                <tbody wire:sortable="updateSeatPlan">
                    @forelse ($seatplan as $seatplan)
                    <tr wire:sortable.item="{{ $seatplan->id }}" wire:key="seatplan-{{ $seatplan->id }}">
                        <td><div class="">{{ $seatplan->id }}</div></td>
                        <td><div class="">{{ $seatplan->student->name }}</div></td>
                        <td><div class="">{{ $seatplan->seat_number }}</div></td>
                    </tr>
                    @empty
                        <tr>
                            <td><div class="font-bold">No Seatplan Found</div></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div> --}}

    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Seat Plan</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Seat Plan</li>
                </ul>
            </div>

            <a wire:navigate.hover href="{{ route('faculty.seatplan.assign') }}" class="mt-3 bg-blue-700 btn btn-ghost hover:bg-blue-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-armchair"><path d="M19 9V6a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v3"/><path d="M3 16a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V11a2 2 0 0 0-4 0z"/><path d="M5 18v2"/><path d="M19 18v2"/></svg>
                <span class="text-sm text-white">Assign Seat Plan</span>
            </a>

            <label for="download_seats" class="mt-3 bg-red-700 btn btn-ghost hover:bg-red-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                <span class="text-sm text-white">Download Seat Plan</span>
            </label>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Filtering</div>
                </div>

                <div class="flex flex-col gap-5 md:flex-row">
                    <div class="w-full">
                        <span class="text-sm font-medium">Select Sections</span>
                        <select wire:model="selectedCourseSection" id="section" class="flex items-center w-full select select-bordered">
                            <option {{ $disabledSection }} value="">All Sections</option>
                            @foreach($courseSecs as $courseSec)
                                <option value="{{ $courseSec->id }}">
                                    {{ $courseSec->course_title ?? 'No Course Title' }} -
                                    {{ $courseSec->section->program }}
                                    {{ $courseSec->section->year }}{{ $courseSec->section->block }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full mb-6"></div>


        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            <div class="overflow-x-auto">
                @include('livewire.faculty.seat-plan.seats');
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        function cancel_downloadseats(){
            document.getElementById('download_seats').checked = false;
            document.getElementById('selectedDLCourseSection').value = '';
        }
    </script>
</x-slot>
