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
            <button type="button" onclick="cancel_load()" class="text-white bg-red-700 btn btn-ghost hover:bg-red-500">Cancel</button>
            <button type="button" wire:click="loadConfiguration" class="text-white bg-blue-700 btn btn-ghost hover:bg-blue-500">Load</button>
        </div>
    </div>
</div>
