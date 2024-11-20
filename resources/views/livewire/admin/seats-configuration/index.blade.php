<x-slot:title>
    Configuration Laboratory Seats
</x-slot>

<div>
    @include('livewire.admin.seats-configuration.load-seats')
    @include('livewire.admin.seats-configuration.export-seats')

    <div class="p-6">
        <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full">
                <h1 class="mb-2 text-2xl font-bold">Seats Configuration</h1>
                <ul class="flex items-center mb-6 text-sm">
                    <li class="mr-2">
                        <a href="#" class="font-medium text-gray-400 hover:text-gray-600">Dashboard</a>
                    </li>
                    <li class="mr-2 font-medium text-gray-600">/</li>
                    <li class="mr-2 font-medium text-gray-600">Seats Configuration</li>
                </ul>
            </div>

            <label for="load_config" class="mt-3 bg-blue-700 btn btn-ghost hover:bg-blue-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                <span class="text-sm text-white">Load Configuration</span>
            </label>

            <label for="export_config" class="mt-3 bg-blue-700 btn btn-ghost hover:bg-blue-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                <span class="text-sm text-white">Save Configuration</span>
            </label>

            <a href="{{ route('admin.settings.index') }}" class="mt-3 bg-red-700 btn btn-ghost hover:bg-red-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                <span class="text-sm text-white">Cancel</span>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3">
            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-2">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Seats</div>
                </div>

                @include('livewire.admin.seats-configuration.seats');

            </div>

            <div class="p-6 border-gray-100 rounded-md shadow-md bg-base-100 shadow-black/5 lg:col-span-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="font-medium">Form Inputs</div>
                </div>

                <form wire:submit.prevent="saveSeatConfig" method="POST" class="space-y-4">
                    @csrf
                    <div class="form-control">
                        <label for="seat_number" class="label">
                            <span class="label-text">Seat Number:</span>
                        </label>
                        <input {{ $disableInptSeat ? 'disabled' : '' }} type="number" wire:model="seat_number" id="seat_number" class="input input-bordered" placeholder="" required>
                    </div>
                    <div class="form-control">
                        <label for="row" class="label">
                            <span class="label-text">Row:</span>
                        </label>
                        <input disabled type="number" wire:model="row" id="row" class="input input-bordered" required>
                    </div>
                    <div class="form-control">
                        <label for="column" class="label">
                            <span class="label-text">Column:</span>
                        </label>
                        <input disabled type="number" wire:model="column" id="column" class="input input-bordered" required>
                    </div>
                    <button {{ $disableBtnAdd ? 'disabled' : '' }} type="submit" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        Add Seat
                    </button>
                    <button {{ $disableBtnBlkAdd ? 'disabled' : '' }} type="submit" wire:click.prevent="bulkaddSeats" id="bulkaddSeats" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                        Add Rows and Columns
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<x-slot:scripts>
    <script>
        function cancel_export(){
            document.getElementById('export_config').checked = false;
            document.getElementById('name').value = '';
        }

        function cancel_load(){
            document.getElementById('load_config').checked = false;
        }

        document.addEventListener('close-modal', function() {
            document.getElementById('export_config').checked = false;
            document.getElementById('load_config').checked = false;
        })

        document.addEventListener('configInptsEn', function() {
            document.getElementById('row').disabled = false;
            document.getElementById('column').disabled = false;
        });

        document.addEventListener('configInptsDis', function() {
            document.getElementById('row').disabled = true;
            document.getElementById('column').disabled = true;
        });
    </script>
</x-slot>
