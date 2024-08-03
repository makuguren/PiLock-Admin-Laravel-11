<x-slot:title>
    Events
</x-slot>

<div>
    @include('livewire.instructor.events.view')

    <div class="p-6">
        <div class="flex flex-row">
            <div class="flex flex-col w-full">
                <h1 class="font-bold text-2xl mb-2">Events</h1>
                <ul class="flex items-center text-sm mb-6">
                    <li class="mr-2">
                        <a href="{{ url('/') }}" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
                    </li>
                    <li class="text-gray-400 mr-2 font-medium">/</li>
                    <li class="text-gray-600 mr-2 font-medium">Events</li>
                </ul>
            </div>
        </div>

        <div class="bg-base-100 border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            {{-- Calendar View --}}
            <div class="">
                <livewire:instructor.events.EventsCalendar/>
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
