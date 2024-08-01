<x-slot:title>
    Edit Laboratory SeatPlan
</x-slot:title>

<div>
    @include('livewire.instructor.seat-plan.loadstud')
    @include('livewire.instructor.seat-plan.view')

    <div class="p-6">

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md mb-6">
            <div class="overflow-x-auto">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Filtering</div>

                    <a href="{{ route('instructor.seatplan.index') }}" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 w-55 btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" /></svg>
                        <span class="text-white text-sm">SeatPlan View</span>
                    </a>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-2">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">SeatPlan View</div>
                </div>

                <div>
                    @include('livewire.instructor.seat-plan.seats')
                </div>
            </div>

            <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md lg:col-span-1">
                <div class="flex justify-between mb-4 items-start">
                    <div class="font-medium">Unassigned Students</div>

                    <label for="load_stud" class="btn btn-ghost bg-blue-700 hover:bg-blue-500 w-55 btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                        <span class="text-white text-sm">Load Students</span>
                    </label>
                </div>

                <div class="p-2" id="list-column" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <ul>
                        @forelse ($fetchStudentsList as $count => $fetchStudentList)
                            @foreach ($fetchStudentList->seatplan as $seatplan)

                                <div class="bg-base-300">
                                    <li class="mb-4" id="item{{ $count+1 }}" value="{{ $seatplan->student_id }}" draggable="true" ondragstart="drag(event)">{{ $seatplan->student->name }}</li>
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
            document.getElementById('load_stud').checked = false;
            document.getElementById('view_seat_modal').checked = false;
        });

        function cancel_load(){
            document.getElementById('load_stud').checked = false;

            document.getElementById('selsubject_id').value = '';
            document.getElementById('selsection_id').value = '';
        }

        function cancel_viewseat(){
            document.getElementById('view_seat_modal').checked = false;
        }

        window.addEventListener('view_seat_modal', event => {
            const view_seat_modal = document.getElementById("view_seat_modal");
            view_seat_modal.checked = true;
        });

        // Drag and Drop Function Below
        function allowDrop(event) {
            event.preventDefault();
        }

        function drag(event) {
            event.dataTransfer.setData("text", event.target.id);
        }

        function drop(event) {
            event.preventDefault();
            var data = event.dataTransfer.getData("text");
            var element = document.getElementById(data);

            if (event.target.classList.contains('box') || event.target.id === 'list-column') {
                if (event.target.classList.contains('box') && event.target.children.length === 0) {
                    logMove(element, event.target);
                    event.target.appendChild(element);
                } else if (event.target.id === 'list-column') {
                    logMove(element, event.target.querySelector('div'));
                    event.target.querySelector('div').appendChild(element);
                }
            }
        }

        function logMove(element, target) {
            let component = @this;

            const fromBox = element.parentNode;
            const fromBoxNum = fromBox.classList.contains('box') ? fromBox.id : "list-column";
            const toBox = target.classList.contains('box') ? target.id : "list-column";

            if (toBox === "list-column") {
                console.log(`${element.value} is moved back to the list`);
            } else {
                component.updateSeat(`${element.value}`, `${toBox}`);
            }
        }

    </script>
</x-slot:scripts>
