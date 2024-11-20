<input type="checkbox" id="load_config" class="modal-toggle" />
<div dialog wire:ignore.self class="modal" role="dialog">
    <div class="w-11/12 max-w-7xl modal-box">
        <h3 class="text-lg font-bold">Load Configuration</h3>

        <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-3">
            <div class="p-6 lg:col-span-2">
                <h4 class="mb-6 font-medium text-md">Seats</h4>
                <div class="grid grid-cols-2 gap-2 p-5 text-white">
                    @php
                        $seatplan = [];
                        if (isset($seatFilePath)) {
                            $filePath = storage_path($seatFilePath);
                            if (File::exists($filePath)) {
                                $seatplan = json_decode(file_get_contents($filePath), true);
                                $seatplan = collect($seatplan)->groupBy('row');
                            } else {
                                // Handle the error if the file does not exist
                                echo "The seat configuration file does not exist.";
                            }
                        } else {
                            // Handle the error if the file path is not set
                            echo "The seat configuration file path is not set.";
                        }
                    @endphp

                    @forelse ($seatplan as $row)
                        <div class="flex justify-center">
                            @foreach ($row as $seat)
                                @if ($seat['seat_number'] === 0)
                                    <div class="flex items-center justify-center w-12 h-12 m-1 border border-black box"></div>
                                @else
                                    <div id="{{ $seat['seat_number'] }}" ondrop="drop(event)" ondragover="allowDrop(event)" class="flex items-center justify-center w-12 h-12 m-1 bg-blue-700 border border-black box">{{ $seat['seat_number'] }}</div>
                                @endif
                            @endforeach
                        </div>
                    @empty
                        Walang Seats
                    @endforelse

                    <div class="flex justify-center col-span-2 mt-5">
                        <div class="flex items-center justify-center h-12 bg-blue-700 border border-black w-72">INSTRUCTORS TABLE</div>
                    </div>
                </div>
            </div>

            <div class="p-6 lg:col-span-1">
                <h4 class="mb-6 font-bold text-md">Saved Configurations</h4>
                @error('selectedSeatConfig') @php toastr()->error($message); @endphp @enderror
                <div class="space-y-4 overflow-y-auto max-h-96">
                    @foreach ($seatbackups as $seatbackup)
                        <div wire:click="loadPreviewSeats({{ $seatbackup->id }})" class="p-2 bg-gray-200 rounded-md shadow-md cursor-pointer" onclick="document.getElementById('{{ str_replace(' ', '_', $seatbackup->name) }}').click()">
                            <input type="radio" id="{{ str_replace(' ', '_', $seatbackup->name) }}" name="seat_config" value="{{ $seatbackup->filepath }}" class="mr-2" wire:model="selectedSeatConfig"> {{ $seatbackup->name }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="modal-action">
            <button type="button" onclick="cancel_load()" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                Cancel
            </button>
            <button type="button" wire:click="loadConfiguration" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"/><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"/><path d="M7 3v4a1 1 0 0 0 1 1h7"/></svg>
                Load
            </button>
        </div>
    </div>
</div>
