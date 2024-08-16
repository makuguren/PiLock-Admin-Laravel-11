<x-slot:title>
    Laboratory Seat Plan
</x-slot>

<div>
    @include('livewire.instructor.seat-plan.view');

    {{-- <ul wire:sortable="updateTaskOrder">
        @foreach ($seatplan as $seatplan)
            <li wire:sortable.item="{{ $task->id }}" wire:key="task-{{ $task->id }}">
                <h4 wire:sortable.handle>{{ $seatplan->student_id }}</h4>
                <button wire:click="removeTask({{ $seatplan->id }})">Remove</button>
            </li>
        @endforeach
    </ul> --}}

    {{-- <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead class="bg-base-200 rounded-md text-md">
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
                <h1 class="font-bold text-2xl mb-2">Seat Plan</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-600 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Seat Plan</li>
                </ul>
            </div>

            <a href="{{ route('instructor.seatplan.assign') }}" class="btn btn-ghost bg-red-700 hover:bg-red-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-armchair"><path d="M19 9V6a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v3"/><path d="M3 16a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V11a2 2 0 0 0-4 0z"/><path d="M5 18v2"/><path d="M19 18v2"/></svg>
                <span class="text-white text-sm">Edit SeatPlan</span>
            </a>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Filtering</div>
                </div>

                <div class="flex flex-col md:flex-row gap-5">
                    <div class="w-full">
                        <span class="font-medium text-sm">Select Sections</span>
                        <select wire:model="selectedCourseSection" id="section" class="select select-bordered flex w-full items-center">
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


        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="overflow-x-auto">
                @include('livewire.instructor.seat-plan.seats');
            </div>
        </div>
    </div>
</div>
