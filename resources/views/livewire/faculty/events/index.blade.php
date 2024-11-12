<x-slot:title>
    Events
</x-slot>

<div>
    @include('livewire.faculty.events.view')

    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Events</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="{{ url('/') }}" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-400">/</li>
                    <li class="mr-2 font-medium text-gray-600">Events</li>
                </ul>
            </div>
        </div>

        <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5">
            {{-- Calendar View --}}
            <div class="">
                <livewire:faculty.events.EventsCalendar/>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        window.addEventListener('viewEvent', event => {
            const view_modal = document.getElementById("view_modal");
            view_modal.checked = true;
        });

        function cancel_event(){
            document.getElementById('view_modal').checked = false;

            document.getElementById('addevent_title').value = '';
            document.getElementById('addevent_description').value = '';
            document.getElementById('addevent_date').value = '';
            document.getElementById('addevent_start').value = '';
            document.getElementById('addevent_end').value = '';
        }
    </script>
</x-slot>
