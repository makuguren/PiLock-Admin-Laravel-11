<x-slot:title>
    Laboratory Seat Plan
</x-slot>

<div>
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

            <a href="{{ route('instructor.seatplan.assign') }}" class="btn bg-red-700 hover:bg-red-500 w-55 btn-sm mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
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
                        <select wire:model="selectedSection" id="section" class="select select-bordered flex w-full items-center">
                            <option {{ $disabledSection }} value="">All Sections</option>
                            @foreach($sections as $id => $section)
                                <option value="{{ $id }}">{{ $section }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full">
                        <span class="font-medium text-sm">Select Subjects</span>
                        <select wire:model="selectedSubject" id="subject" class="select select-bordered flex w-full items-center">
                            <option {{ $disabledSubject }} value="">All Subjects</option>
                            @foreach($subjects as $id => $subject)
                                <option value="{{ $id }}">{{ $subject }}</option>
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
