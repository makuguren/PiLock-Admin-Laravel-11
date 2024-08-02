<div>
    @can('Create Events')
        @include('admin.events.create')
    @endcan
    @can('View Events')
        @include('admin.events.view')
    @endcan
    @can('Delete Events')
        @include('admin.events.delete')
    @endcan

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
                <livewire:admin.events.EventsCalendar/>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>

        function delete_event(){
            const delete_modal = document.getElementById("delete_modal");
            delete_modal.checked = true;
            view_modal.checked = false;
        }

        window.addEventListener('getDateCalendar', event => {
            //Call the OpenModal Function
            const add_modal = document.getElementById("add_modal");
            add_modal.checked = true;

            //Retrieve Values from the Date by Organized
            // const dateFormat = (event.detail[0] + '/sasasas' + event.detail[1] + '/' + event.detail[2]);
            // document.getElementById("addevent_date").value = dateFormat
        });

        window.addEventListener('viewEvent', event => {
            const view_modal = document.getElementById("view_modal");
            view_modal.checked = true;
        });

        function cancel_event(){
            document.getElementById('add_modal').checked = false;
            document.getElementById('view_modal').checked = false;
            document.getElementById('delete_modal').checked = false;

            document.getElementById('addevent_title').value = '';
            document.getElementById('addevent_description').value = '';
            document.getElementById('addevent_date').value = '';
            document.getElementById('addevent_start').value = '';
            document.getElementById('addevent_end').value = '';

            // document.getElementById('editevent_title').value = '';
            // document.getElementById('editevent_description').value = '';
            // document.getElementById('editevent_date').value = '';
            // document.getElementById('editevent_start').value = '';
            // document.getElementById('editevent_end').value = '';
        }

        function enable_event(){
            document.getElementById('editevent_title').disabled = false;
            document.getElementById('editevent_description').disabled = false;
            document.getElementById('editevent_start').disabled = false;
            document.getElementById('editevent_end').disabled = false;

            document.getElementById('editBtn').disabled = true;
            document.getElementById('updateBtn').disabled = false;
        }

        window.addEventListener('close-modal', event => {
            document.getElementById('add_modal').checked = false;
            document.getElementById('view_modal').checked = false;
            document.getElementById('delete_modal').checked = false;
        });

    </script>
</x-slot:scripts>
