<x-slot:title>
    Edit Laboratory SeatPlan
</x-slot:title>

<div>
    @include('livewire.archive.instructor.seatplan-view')

    <div class="p-6">

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md mb-6">
            <div class="overflow-x-auto">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Filtering</div>

                    <a wire:navigate.hover href="{{ route('archive.instructor.seatplan.index') }}" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 w-55 btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-big-left"><path d="M18 15h-6v4l-7-7 7-7v4h6v6z"/></svg>
                        <span class="text-white text-sm">SeatPlan View</span>
                    </a>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">SeatPlan View</div>
                </div>

                <div>
                    @include('livewire.archive.instructor.seatplan-seats')
                </div>
            </div>

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-1">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Unassigned Students</div>
                </div>

                <div class="p-2" id="list-column" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <ul>
                        @forelse ($fetchStudentsList as $count => $fetchStudentList)
                            @foreach ($fetchStudentList->seatplan as $seatplan)

                                <div class="bg-base-300">
                                    <li class="mb-4" id="item{{ $count+1 }}" value="{{ $seatplan->student_id }}" draggable="true" ondragstart="drag(event)">{{ $seatplan->student->first_name }} {{ $seatplan->student->last_name }}</li>
                                </div>

                            @endforeach
                        @empty
                            No Students Found
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('close-modal', event => {
            document.getElementById('view_seat_modal').checked = false;
        });

        function cancel_viewseat(){
            document.getElementById('view_seat_modal').checked = false;
        }

        function cancel_previewseat(){
            document.getElementById('preview_seat_modal').checked = false;
        }

        window.addEventListener('view_seat_modal', event => {
            const view_seat_modal = document.getElementById("view_seat_modal");
            view_seat_modal.checked = true;
        });

        window.addEventListener('preview_seat_modal', event => {
            const preview_seat_modal = document.getElementById("preview_seat_modal");
            preview_seat_modal.checked = true;
        });

        // Drag and Drop Function Below
        // function allowDrop(event) {
        //     event.preventDefault();
        // }

        // function drag(event) {
        //     event.dataTransfer.setData("text", event.target.id);
        // }

        // function drop(event) {
        //     event.preventDefault();
        //     var data = event.dataTransfer.getData("text");
        //     var element = document.getElementById(data);

        //     if (event.target.classList.contains('box') || event.target.id === 'list-column') {
        //         if (event.target.classList.contains('box') && event.target.children.length === 0) {
        //             logMove(element, event.target);
        //             event.target.appendChild(element);
        //         } else if (event.target.id === 'list-column') {
        //             logMove(element, event.target.querySelector('div'));
        //             event.target.querySelector('div').appendChild(element);
        //         }
        //     }
        // }

        // function logMove(element, target) {
        //     let component = @this;

        //     const fromBox = element.parentNode;
        //     const fromBoxNum = fromBox.classList.contains('box') ? fromBox.id : "list-column";
        //     const toBox = target.classList.contains('box') ? target.id : "list-column";

        //     if (toBox === "list-column") {
        //         console.log(`${element.value} is moved back to the list`);
        //     } else {
        //         component.updateSeat(`${element.value}`, `${toBox}`);
        //     }
        // }

    </script>
</x-slot:scripts>
