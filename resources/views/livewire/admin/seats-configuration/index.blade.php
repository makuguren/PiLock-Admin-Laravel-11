<x-slot:title>
    Configuration Laboratory Seats
</x-slot>

<div>
    @include('livewire.admin.seats-configuration.load-seats')
    @include('livewire.admin.seats-configuration.export-seats')

    <div class="p-6">
        <div class="flex flex-row">
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
            <label for="load_config" class="mt-3 bg-blue-700 btn hover:bg-blue-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-crown"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></svg>
                <span class="text-sm text-white">Load Configuration</span>
            </label>

            <label for="export_config" class="mt-3 bg-blue-700 btn hover:bg-blue-500 w-55 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-crown"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></svg>
                <span class="text-sm text-white">Save Configuration</span>
            </label>
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
                    <button {{ $disableBtnAdd ? 'disabled' : '' }} type="submit" class="text-white bg-blue-700 btn hover:bg-blue-500">Add Seat</button>
                    <button {{ $disableBtnBlkAdd ? 'disabled' : '' }} type="submit" wire:click.prevent="bulkaddSeats" id="bulkaddSeats" class="text-white bg-blue-700 btn hover:bg-blue-500">Add Rows and Columns</button>
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
